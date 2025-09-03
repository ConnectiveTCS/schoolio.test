<?php

namespace App\Console\Commands;

use App\Services\EscalationService;
use Illuminate\Console\Command;

class ProcessEscalations extends Command
{
    protected $signature = 'support:process-escalations {--dry-run : Show what would be escalated without actually escalating}';
    protected $description = 'Process ticket escalations based on configured rules';

    public function handle(EscalationService $escalationService): int
    {
        $dryRun = $this->option('dry-run');

        $this->info('Processing ticket escalations...');

        if ($dryRun) {
            $this->warn('DRY RUN MODE - No tickets will be actually escalated');
        }

        $escalatedCount = $escalationService->processEscalations();

        if ($escalatedCount > 0) {
            $this->info("Successfully escalated {$escalatedCount} tickets");
        } else {
            $this->info('No tickets required escalation');
        }

        return self::SUCCESS;
    }
}
