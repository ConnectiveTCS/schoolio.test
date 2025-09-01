<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;

class CreateTestTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:create-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test tenant';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenant = Tenant::create(['name' => 'Test School']);
        $this->info('Tenant created with ID: ' . $tenant->id);
    }
}
