<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class EscalationRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'priority_order',
        'trigger_statuses',
        'trigger_priorities',
        'hours_threshold',
        'escalation_type',
        'new_priority',
        'escalate_to_admin_id',
        'notify_admin_ids',
        'new_status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'trigger_statuses' => 'array',
        'trigger_priorities' => 'array',
        'notify_admin_ids' => 'array',
    ];

    public function escalateToAdmin(): BelongsTo
    {
        return $this->belongsTo(CentralAdmin::class, 'escalate_to_admin_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('priority_order', 'asc');
    }

    public function shouldEscalate(SupportTicket $ticket): bool
    {
        // Check if ticket status matches trigger statuses
        if ($this->trigger_statuses && !in_array($ticket->status, $this->trigger_statuses)) {
            return false;
        }

        // Check if ticket priority matches trigger priorities
        if ($this->trigger_priorities && !in_array($ticket->priority, $this->trigger_priorities)) {
            return false;
        }

        // Check if enough time has passed
        $hoursOld = $ticket->created_at->diffInHours(now());
        if ($hoursOld < $this->hours_threshold) {
            return false;
        }

        // Check if already escalated within the threshold period
        if ($ticket->last_escalated_at) {
            $hoursSinceEscalation = $ticket->last_escalated_at->diffInHours(now());
            if ($hoursSinceEscalation < $this->hours_threshold) {
                return false;
            }
        }

        return true;
    }

    public function execute(SupportTicket $ticket): bool
    {
        try {
            switch ($this->escalation_type) {
                case 'priority_bump':
                    return $this->escalatePriority($ticket);

                case 'reassign':
                    return $this->reassignTicket($ticket);

                case 'notify':
                    return $this->notifyAdmins($ticket);

                case 'status_change':
                    return $this->changeStatus($ticket);

                default:
                    return false;
            }
        } catch (\Exception $e) {
            Log::error('Escalation rule execution failed', [
                'rule_id' => $this->id,
                'ticket_id' => $ticket->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function escalatePriority(SupportTicket $ticket): bool
    {
        if (!$this->new_priority) {
            return false;
        }

        $ticket->update([
            'priority' => $this->new_priority,
            'last_escalated_at' => now(),
            'escalation_level' => $ticket->escalation_level + 1,
        ]);

        return true;
    }

    private function reassignTicket(SupportTicket $ticket): bool
    {
        if (!$this->escalate_to_admin_id) {
            return false;
        }

        $ticket->update([
            'assigned_admin_id' => $this->escalate_to_admin_id,
            'last_escalated_at' => now(),
            'escalation_level' => $ticket->escalation_level + 1,
        ]);

        return true;
    }

    private function notifyAdmins(SupportTicket $ticket): bool
    {
        if (!$this->notify_admin_ids) {
            return false;
        }

        // TODO: Implement notification logic
        // This could send emails, Slack messages, etc.

        $ticket->update([
            'last_escalated_at' => now(),
            'escalation_level' => $ticket->escalation_level + 1,
        ]);

        return true;
    }

    private function changeStatus(SupportTicket $ticket): bool
    {
        if (!$this->new_status) {
            return false;
        }

        $ticket->update([
            'status' => $this->new_status,
            'last_escalated_at' => now(),
            'escalation_level' => $ticket->escalation_level + 1,
        ]);

        return true;
    }
}
