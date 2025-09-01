<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Initialize tenant context
$tenant = \App\Models\Tenant::find(1);
if ($tenant) {
    tenancy()->initialize($tenant);
    echo "=== STORAGE PATH DEBUGGING (Tenant: {$tenant->name}) ===\n";
} else {
    echo "Tenant not found!\n";
    exit;
}

use Illuminate\Support\Facades\Storage;

$testPath = "tenant_1/support_tickets/1756711135_68b548dfb0d08_2 (2) (1).png";

echo "Test path: $testPath\n";
echo "Tenant ID: " . tenant('id') . "\n";

$storageDisk = Storage::disk('public');
echo "Storage disk root: " . $storageDisk->path('') . "\n";
echo "Storage disk calculated path: " . $storageDisk->path($testPath) . "\n";

$manualTenantPath = storage_path("tenant" . tenant('id') . "/app/public/" . $testPath);
echo "Manual tenant path: $manualTenantPath\n";

echo "Storage disk path exists: " . (file_exists($storageDisk->path($testPath)) ? 'YES' : 'NO') . "\n";
echo "Manual tenant path exists: " . (file_exists($manualTenantPath) ? 'YES' : 'NO') . "\n";

// List actual storage config
echo "\n=== STORAGE CONFIG ===\n";
$config = config('filesystems.disks.public');
echo "Public disk config: " . json_encode($config, JSON_PRETTY_PRINT) . "\n";
