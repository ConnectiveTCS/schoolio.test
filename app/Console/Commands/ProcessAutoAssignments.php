<?php

namespace App\Console\Commands;

use App\Models\SupportTicket;
use App\Services\AutoAssignmentService;
use Illuminate\Console\Command;

class ProcessAutoAssignments extends Command
{
    protected $signature = 'support:process-auto-assignments {--dry-run : Show what would be assigned without actually assigning}';
    protected $description = 'Process automatic ticket assignments based on configured rules';

    public function handle(AutoAssignmentService $autoAssignmentService): int
    {
        $dryRun = $this->option('dry-run');

        $this->info('Processing automatic ticket assignments...');

        // Get unassigned tickets
        $unassignedTickets = SupportTicket::whereNull('assigned_admin_id')
            ->whereIn('status', ['open'])
            ->get();

        if ($unassignedTickets->isEmpty()) {
            $this->info('No unassigned tickets found.');
            return self::SUCCESS;
        }

        $assignedCount = 0;
        $this->info("Found {$unassignedTickets->count()} unassigned tickets");

        foreach ($unassignedTickets as $ticket) {
            if ($dryRun) {
                // Simulate assignment
                $this->line("Would process ticket: {$ticket->ticket_number} - {$ticket->title}");
            } else {
                $assigned = $autoAssignmentService->assignTicket($ticket);

                if ($assigned) {
                    $assignedCount++;
                    $this->info("✓ Assigned ticket {$ticket->ticket_number} to admin ID: {$ticket->fresh()->assigned_admin_id}");
                } else {
                    $this->line("- No rule matched for ticket {$ticket->ticket_number}");
                }
            }
        }

        if (!$dryRun) {
            $this->info("Successfully assigned {$assignedCount} tickets");
        } else {
            $this->info("Dry run completed - no tickets were actually assigned");
        }

        return self::SUCCESS;
    }
}
