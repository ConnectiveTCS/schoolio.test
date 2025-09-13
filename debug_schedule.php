<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Initialize tenant context
try {
    $tenant = \App\Models\Tenant::first();
    if ($tenant) {
        tenancy()->initialize($tenant);
        echo "Tenant initialized: " . $tenant->id . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error initializing tenant: " . $e->getMessage() . PHP_EOL;
}

// Query for DP2 class
echo "=== Searching for DP2 class ===" . PHP_EOL;
$classes = \App\Models\TenantClasses::with(['teacher.user'])
    ->where('name', 'LIKE', '%DP2%')
    ->get();

if ($classes->isEmpty()) {
    echo "No classes found with 'DP2' in the name" . PHP_EOL;

    // Let's check all classes to see what exists
    echo "=== All classes ===" . PHP_EOL;
    $allClasses = \App\Models\TenantClasses::with(['teacher.user'])->get();
    foreach ($allClasses as $class) {
        echo "- " . $class->name . " (Teacher: " . ($class->teacher->user->name ?? 'Unknown') . ")" . PHP_EOL;
    }
} else {
    foreach ($classes as $class) {
        echo "Found class:" . PHP_EOL;
        echo "  ID: " . $class->id . PHP_EOL;
        echo "  Name: " . $class->name . PHP_EOL;
        echo "  Teacher: " . ($class->teacher->user->name ?? 'No teacher assigned') . PHP_EOL;
        echo "  Active: " . ($class->is_active ? 'Yes' : 'No') . PHP_EOL;
        echo "  Schedule: " . ($class->schedule ? json_encode($class->schedule, JSON_PRETTY_PRINT) : 'No schedule') . PHP_EOL;
        echo "---" . PHP_EOL;
    }
}

// Check for Shayna Feest teacher
echo "=== Searching for teacher 'Shayna Feest' ===" . PHP_EOL;
$teachers = \Illuminate\Support\Facades\DB::table('tenant_teachers')
    ->join('users', 'tenant_teachers.user_id', '=', 'users.id')
    ->where('users.name', 'LIKE', '%Shayna%')
    ->orWhere('users.name', 'LIKE', '%Feest%')
    ->select('tenant_teachers.*', 'users.name as teacher_name')
    ->get();

if ($teachers->isEmpty()) {
    echo "No teacher found with name containing 'Shayna' or 'Feest'" . PHP_EOL;
} else {
    foreach ($teachers as $teacher) {
        echo "Found teacher: " . $teacher->teacher_name . " (ID: " . $teacher->id . ")" . PHP_EOL;

        // Find classes for this teacher
        $teacherClasses = \App\Models\TenantClasses::where('teacher_id', $teacher->id)->get();
        foreach ($teacherClasses as $class) {
            echo "  - Class: " . $class->name . " (Active: " . ($class->is_active ? 'Yes' : 'No') . ")" . PHP_EOL;
        }
    }
}
