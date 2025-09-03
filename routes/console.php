<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule workflow automation commands
Schedule::command('support:process-auto-assignments')->everyMinute();
Schedule::command('support:process-escalations')->everyFiveMinutes();
Schedule::command('support:update-sla-statuses')->everyMinute();
Schedule::command('support:process-reminders')->everyMinute();
