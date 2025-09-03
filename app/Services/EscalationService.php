<?php

namespace App\Services;

use App\Models\SupportTicket;
use App\Models\EscalationRule;
use App\Models\SupportTicketReply;
use Illuminate\Support\Facades\Log;

class EscalationService
{
    public function processEscalations(): int
    {
        $escalatedCount = 0;

        $rules = EscalationRule::active()
            ->ordered()
            ->get();

        $tickets = SupportTicket::whereIn('status', ['open', 'in_progress'])
            ->get();

        foreach ($tickets as $ticket) {
            foreach ($rules as $rule) {
                if ($rule->shouldEscalate($ticket)) {
                    if ($this->executeEscalation($rule, $ticket)) {
                        $escalatedCount++;

                        // Log the escalation
                        $this->logEscalation($rule, $ticket);

                        // Only apply the first matching rule
                        break;
                    }
                }
            }
        }

        return $escalatedCount;
    }

    private function executeEscalation(EscalationRule $rule, SupportTicket $ticket): bool
    {
        $success = $rule->execute($ticket);

        if ($success) {
            // Create an internal note about the escalation
            $this->createEscalationNote($rule, $ticket);
        }

        return $success;
    }

    private function createEscalationNote(EscalationRule $rule, SupportTicket $ticket): void
    {
        $message = "Ticket automatically escalated using rule: {$rule->name}\n";
        $message .= "Escalation Type: " . ucfirst(str_replace('_', ' ', $rule->escalation_type)) . "\n";

        switch ($rule->escalation_type) {
            case 'priority_bump':
                $message .= "Priority changed to: {$rule->new_priority}";
                break;
            case 'reassign':
                $admin = $rule->escalateToAdmin;
                $message .= "Reassigned to: " . ($admin ? $admin->name : 'Unknown Admin');
                break;
            case 'status_change':
                $message .= "Status changed to: {$rule->new_status}";
                break;
            case 'notify':
                $message .= "Notifications sent to designated admins";
                break;
        }

        SupportTicketReply::create([
            'support_ticket_id' => $ticket->id,
            'message' => $message,
            'sender_type' => 'system',
            'sender_details' => [
                'id' => 0,
                'name' => 'System Escalation',
                'email' => 'system@schoolio.test',
            ],
            'is_internal' => true,
        ]);
    }

    private function logEscalation(EscalationRule $rule, SupportTicket $ticket): void
    {
        Log::info('Ticket escalated', [
            'ticket_id' => $ticket->id,
            'ticket_number' => $ticket->ticket_number,
            'rule_id' => $rule->id,
            'rule_name' => $rule->name,
            'escalation_type' => $rule->escalation_type,
            'escalation_level' => $ticket->escalation_level,
        ]);
    }
}
