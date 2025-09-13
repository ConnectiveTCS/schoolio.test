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

echo "=== Testing Fixed Schedule Processing ===" . PHP_EOL;

// Simulate the fixed controller logic
$classes = \App\Models\TenantClasses::with(['teacher.user', 'students'])
    ->where('is_active', true)
    ->get();

$processedClasses = $classes->map(function ($class) {
    $schedule = $class->schedule;
    $processedSchedule = null;

    // Handle both array and string schedule data
    if (is_string($schedule)) {
        $schedule = json_decode($schedule, true);
    }

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

    return [
        'id' => $class->id,
        'name' => $class->name,
        'subject' => $class->subject,
        'room' => $class->room,
        'teacher_name' => $class->teacher->user->name ?? 'Unknown',
        'student_count' => $class->students->count(),
        'schedule' => $processedSchedule,
        'is_active' => $class->is_active,
    ];
});

echo "Processed " . $processedClasses->count() . " classes:" . PHP_EOL;

foreach ($processedClasses as $class) {
    echo "- " . $class['name'] . " (" . $class['teacher_name'] . ")" . PHP_EOL;
    if ($class['schedule']) {
        echo "  Days: " . implode(', ', $class['schedule']['days']) . PHP_EOL;
        echo "  Time: " . ($class['schedule']['time_display'] ?? 'Not set') . PHP_EOL;
    } else {
        echo "  No schedule data" . PHP_EOL;
    }
}

// Test schedule by day grouping
echo PHP_EOL . "=== Schedule by Day Grouping ===" . PHP_EOL;
$scheduleByDay = [
    'Monday' => [],
    'Tuesday' => [],
    'Wednesday' => [],
    'Thursday' => [],
    'Friday' => [],
    'Saturday' => [],
    'Sunday' => [],
];

foreach ($processedClasses as $class) {
    if ($class['schedule'] && isset($class['schedule']['days'])) {
        foreach ($class['schedule']['days'] as $day) {
            if (isset($scheduleByDay[$day])) {
                $scheduleByDay[$day][] = $class;
            }
        }
    }
}

foreach ($scheduleByDay as $day => $dayClasses) {
    echo $day . ": " . count($dayClasses) . " classes" . PHP_EOL;
    foreach ($dayClasses as $class) {
        echo "  - " . $class['name'] . " (" . $class['teacher_name'] . ") " . ($class['schedule']['time_display'] ?? '') . PHP_EOL;
    }
}
