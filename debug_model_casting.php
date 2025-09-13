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

echo "=== Testing Model Casting ===" . PHP_EOL;

// Get the specific DP2 class with Shayna Feest
$class = \App\Models\TenantClasses::with(['teacher.user'])
    ->where('name', 'DP2')
    ->whereHas('teacher.user', function ($query) {
        $query->where('name', 'LIKE', '%Shayna%');
    })
    ->first();

if ($class) {
    echo "Found DP2 class with Shayna Feest:" . PHP_EOL;
    echo "Class ID: " . $class->id . PHP_EOL;
    echo "Class Name: " . $class->name . PHP_EOL;
    echo "Teacher: " . $class->teacher->user->name . PHP_EOL;

    $schedule = $class->schedule;
    echo "Schedule type: " . gettype($schedule) . PHP_EOL;
    echo "Schedule is_array: " . (is_array($schedule) ? 'YES' : 'NO') . PHP_EOL;
    echo "Schedule value: " . var_export($schedule, true) . PHP_EOL;

    // Try to access the raw attribute
    echo "Raw schedule attribute: " . $class->getAttributes()['schedule'] . PHP_EOL;

    // Force decode if it's a string
    if (is_string($schedule)) {
        $decodedSchedule = json_decode($schedule, true);
        echo "JSON decoded schedule: " . var_export($decodedSchedule, true) . PHP_EOL;
        echo "Decoded is_array: " . (is_array($decodedSchedule) ? 'YES' : 'NO') . PHP_EOL;
    }
} else {
    echo "No DP2 class found with Shayna Feest" . PHP_EOL;
}

// Test all models to see casting behavior
echo PHP_EOL . "=== Testing All Models Cast Behavior ===" . PHP_EOL;
$allClasses = \App\Models\TenantClasses::take(3)->get();
foreach ($allClasses as $testClass) {
    echo "Class: " . $testClass->name . PHP_EOL;
    echo "  Schedule type: " . gettype($testClass->schedule) . PHP_EOL;
    echo "  Is array: " . (is_array($testClass->schedule) ? 'YES' : 'NO') . PHP_EOL;
    echo "  Raw: " . $testClass->getAttributes()['schedule'] . PHP_EOL;
}
