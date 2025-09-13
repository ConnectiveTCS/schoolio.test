<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Initialize tenant context
try {
    $tenant = \App\Models\Tenant::first();
    if ($tenant) {
        tenancy()->initialize($tenant);
    }
} catch (Exception $e) {
    echo "Error initializing tenant: " . $e->getMessage() . PHP_EOL;
}

// Simulate the ScheduleController logic
echo "=== Debugging Schedule Controller Logic ===" . PHP_EOL;

// Get all active classes
$classes = \App\Models\TenantClasses::with(['teacher.user', 'students'])
    ->where('is_active', true)
    ->get();

echo "Found " . $classes->count() . " active classes:" . PHP_EOL;

foreach ($classes as $class) {
    echo "Class: " . $class->name . PHP_EOL;
    echo "  Teacher: " . ($class->teacher->user->name ?? 'Unknown') . PHP_EOL;
    echo "  Schedule Raw: " . ($class->schedule ? json_encode($class->schedule) : 'null') . PHP_EOL;

    // Process schedule like in the controller
    $schedule = $class->schedule;
    $processedSchedule = null;

    if (is_array($schedule)) {
        $processedSchedule = [
            'days' => $schedule['days'] ?? [],
            'start_time' => $schedule['start_time'] ?? null,
            'end_time' => $schedule['end_time'] ?? null,
            'time_display' => isset($schedule['start_time'], $schedule['end_time'])
                ? $schedule['start_time'] . ' - ' . $schedule['end_time']
                : null,
            'notes' => $schedule['notes'] ?? null,
        ];
    }

    echo "  Processed Schedule: " . json_encode($processedSchedule) . PHP_EOL;
    echo "---" . PHP_EOL;
}

// Test schedule by day grouping
echo "=== Schedule by Day Grouping ===" . PHP_EOL;
$scheduleByDay = [
    'Monday' => [],
    'Tuesday' => [],
    'Wednesday' => [],
    'Thursday' => [],
    'Friday' => [],
    'Saturday' => [],
    'Sunday' => [],
];

foreach ($classes as $class) {
    $processedClass = [
        'id' => $class->id,
        'name' => $class->name,
        'teacher_name' => $class->teacher->user->name ?? 'Unknown',
    ];

    $schedule = $class->schedule;
    $processedSchedule = null;

    if (is_array($schedule)) {
        $processedSchedule = [
            'days' => $schedule['days'] ?? [],
            'start_time' => $schedule['start_time'] ?? null,
            'end_time' => $schedule['end_time'] ?? null,
        ];
    }

    $processedClass['schedule'] = $processedSchedule;

    if ($processedSchedule && isset($processedSchedule['days'])) {
        foreach ($processedSchedule['days'] as $day) {
            if (isset($scheduleByDay[$day])) {
                $scheduleByDay[$day][] = $processedClass;
                echo "Added " . $class->name . " to " . $day . PHP_EOL;
            }
        }
    }
}

echo "=== Final Schedule by Day ===" . PHP_EOL;
foreach ($scheduleByDay as $day => $dayClasses) {
    echo $day . ": " . count($dayClasses) . " classes" . PHP_EOL;
    foreach ($dayClasses as $class) {
        echo "  - " . $class['name'] . " (" . $class['teacher_name'] . ")" . PHP_EOL;
    }
}
