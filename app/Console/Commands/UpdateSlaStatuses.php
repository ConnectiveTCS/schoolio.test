<?php

namespace App\Console\Commands;

use App\Services\SlaService;
use Illuminate\Console\Command;

class UpdateSlaStatuses extends Command
{
    protected $signature = 'support:update-sla-statuses';
    protected $description = 'Update SLA statuses for all active tickets';

    public function handle(SlaService $slaService): int
    {
        $this->info('Updating SLA statuses...');

        $updatedCount = $slaService->updateSlaStatuses();

        if ($updatedCount > 0) {
            $this->info("Updated SLA status for {$updatedCount} tickets");
        } else {
            $this->info('No SLA status updates required');
        }

        // Show tickets approaching SLA breach
        $approachingTickets = $slaService->getTicketsApproachingSla(4); // 4 hours threshold
        if ($approachingTickets->count() > 0) {
            $this->warn("⚠️  {$approachingTickets->count()} tickets are approaching SLA deadline:");
            foreach ($approachingTickets as $ticket) {
                $this->line("  - {$ticket->ticket_number}: Due in " .
                    $ticket->sla_due_at->diffForHumans() .
                    " (Priority: {$ticket->priority})");
            }
        }

        // Show breached tickets
        $breachedTickets = $slaService->getBreachedTickets();
        if ($breachedTickets->count() > 0) {
            $this->error("❌ {$breachedTickets->count()} tickets have breached SLA:");
            foreach ($breachedTickets as $ticket) {
                $this->line("  - {$ticket->ticket_number}: Overdue by " .
                    $ticket->sla_due_at->diffForHumans() .
                    " (Priority: {$ticket->priority})");
            }
        }

        return self::SUCCESS;
    }
}
