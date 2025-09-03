<?php

namespace App\Services;

use App\Models\SupportTicket;
use App\Models\AutoAssignmentRule;
use App\Models\CentralAdmin;
use Illuminate\Support\Facades\Log;

class AutoAssignmentService
{
    public function assignTicket(SupportTicket $ticket): bool
    {
        // Skip if already assigned
        if ($ticket->assigned_admin_id) {
            return false;
        }

        $rules = AutoAssignmentRule::active()
            ->ordered()
            ->with('assignedAdmin')
            ->get();

        foreach ($rules as $rule) {
            if ($rule->matches($ticket)) {
                $adminId = $this->selectAdminByStrategy($rule, $ticket);

                if ($adminId) {
                    $ticket->update([
                        'assigned_admin_id' => $adminId,
                        'status' => 'in_progress'
                    ]);

                    Log::info('Ticket auto-assigned', [
                        'ticket_id' => $ticket->id,
                        'rule_id' => $rule->id,
                        'admin_id' => $adminId
                    ]);

                    return true;
                }
            }
        }

        return false;
    }

    private function selectAdminByStrategy(AutoAssignmentRule $rule, SupportTicket $ticket): ?int
    {
        return match ($rule->assignment_strategy) {
            'specific_admin' => $rule->assigned_admin_id,
            'round_robin' => $this->getRoundRobinAdmin($rule),
            'least_loaded' => $this->getLeastLoadedAdmin($rule),
            default => $rule->assigned_admin_id
        };
    }

    private function getRoundRobinAdmin(AutoAssignmentRule $rule): ?int
    {
        // Get all admins that could be assigned based on the rule
        $adminIds = $this->getEligibleAdmins($rule);

        if (empty($adminIds)) {
            return $rule->assigned_admin_id;
        }

        // Find the last assigned admin for this rule and get the next one
        $lastAssignedTicket = SupportTicket::whereIn('assigned_admin_id', $adminIds)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$lastAssignedTicket) {
            return $adminIds[0];
        }

        $currentIndex = array_search($lastAssignedTicket->assigned_admin_id, $adminIds);
        $nextIndex = ($currentIndex + 1) % count($adminIds);

        return $adminIds[$nextIndex];
    }

    private function getLeastLoadedAdmin(AutoAssignmentRule $rule): ?int
    {
        $adminIds = $this->getEligibleAdmins($rule);

        if (empty($adminIds)) {
            return $rule->assigned_admin_id;
        }

        // Count open tickets for each admin
        $adminTicketCounts = SupportTicket::whereIn('assigned_admin_id', $adminIds)
            ->whereIn('status', ['open', 'in_progress'])
            ->selectRaw('assigned_admin_id, COUNT(*) as ticket_count')
            ->groupBy('assigned_admin_id')
            ->pluck('ticket_count', 'assigned_admin_id');

        // Find admin with least tickets
        $leastLoadedAdminId = null;
        $minTickets = PHP_INT_MAX;

        foreach ($adminIds as $adminId) {
            $ticketCount = $adminTicketCounts->get($adminId, 0);

            if ($ticketCount < $minTickets) {
                $minTickets = $ticketCount;
                $leastLoadedAdminId = $adminId;
            }
        }

        return $leastLoadedAdminId;
    }

    private function getEligibleAdmins(AutoAssignmentRule $rule): array
    {
        // For now, return just the assigned admin
        // This could be extended to support admin groups, skills, etc.
        return [$rule->assigned_admin_id];
    }
}
