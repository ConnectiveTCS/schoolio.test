<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DropAssetsTable extends Command
{
    protected $signature = 'drop:assets-table';
    protected $description = 'Drop the assets table if it exists';

    public function handle()
    {
        try {
            if (Schema::hasTable('assets')) {
                Schema::drop('assets');
                $this->info('Assets table dropped successfully');
            } else {
                $this->info('Assets table does not exist');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
