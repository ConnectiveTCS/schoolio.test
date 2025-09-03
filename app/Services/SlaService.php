<?php

namespace App\Services;

use App\Models\SupportTicket;
use App\Models\SlaPolicy;
use App\Models\FollowUpReminder;
use Illuminate\Support\Facades\Log;

class SlaService
{
    public function assignSlaPolicy(SupportTicket $ticket): void
    {
        $slaPolicy = SlaPolicy::active()
            ->ordered()
            ->get()
            ->first(function ($policy) use ($ticket) {
                return $policy->appliesTo($ticket);
            });

        if ($slaPolicy) {
            $slaDeadline = $slaPolicy->calculateSlaDeadline($ticket, 'resolution');

            $ticket->update([
                'sla_policy_id' => $slaPolicy->id,
                'sla_due_at' => $slaDeadline,
                'sla_status' => 'on_track',
            ]);

            // Schedule SLA warning reminders
            $this->scheduleSlaReminders($ticket, $slaPolicy);

            Log::info('SLA policy assigned to ticket', [
                'ticket_id' => $ticket->id,
                'sla_policy_id' => $slaPolicy->id,
                'sla_due_at' => $slaDeadline?->toISOString(),
            ]);
        }
    }

    public function updateSlaStatuses(): int
    {
        $updatedCount = 0;

        $tickets = SupportTicket::whereNotNull('sla_policy_id')
            ->whereIn('status', ['open', 'in_progress'])
            ->with('slaPolicy')
            ->get();

        foreach ($tickets as $ticket) {
            $oldStatus = $ticket->sla_status;
            $newStatus = $ticket->slaPolicy->getSlaStatus($ticket, 'resolution');

            if ($oldStatus !== $newStatus) {
                $ticket->update(['sla_status' => $newStatus]);
                $updatedCount++;

                Log::info('SLA status updated', [
                    'ticket_id' => $ticket->id,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                ]);
            }
        }

        return $updatedCount;
    }

    public function getTicketsApproachingSla(int $hoursThreshold = 2): \Illuminate\Database\Eloquent\Collection
    {
        $thresholdTime = now()->addHours($hoursThreshold);

        return SupportTicket::whereNotNull('sla_due_at')
            ->where('sla_due_at', '<=', $thresholdTime)
            ->where('sla_due_at', '>', now())
            ->whereIn('status', ['open', 'in_progress'])
            ->with(['assignedAdmin', 'tenant'])
            ->get();
    }

    public function getBreachedTickets(): \Illuminate\Database\Eloquent\Collection
    {
        return SupportTicket::whereNotNull('sla_due_at')
            ->where('sla_due_at', '<', now())
            ->whereIn('status', ['open', 'in_progress'])
            ->with(['assignedAdmin', 'tenant'])
            ->get();
    }

    private function scheduleSlaReminders(SupportTicket $ticket, SlaPolicy $slaPolicy): void
    {
        if (!$ticket->sla_due_at || !$ticket->assigned_admin_id) {
            return;
        }

        // Schedule warning reminder
        $warningTime = $this->calculateWarningTime($ticket->sla_due_at, $slaPolicy->warning_threshold_percent);
        if ($warningTime > now()) {
            FollowUpReminder::scheduleSlaWarning(
                $ticket,
                $ticket->assignedAdmin,
                $warningTime,
                'resolution'
            );
        }

        // Schedule critical reminder
        $criticalTime = $this->calculateWarningTime($ticket->sla_due_at, $slaPolicy->critical_threshold_percent);
        if ($criticalTime > now()) {
            FollowUpReminder::scheduleSlaWarning(
                $ticket,
                $ticket->assignedAdmin,
                $criticalTime,
                'resolution'
            );
        }
    }

    private function calculateWarningTime(\DateTime $slaDeadline, int $thresholdPercent): \DateTime
    {
        $totalMinutes = now()->diffInMinutes($slaDeadline);
        $warningMinutes = ($totalMinutes * $thresholdPercent) / 100;

        return now()->addMinutes($warningMinutes);
    }
}
