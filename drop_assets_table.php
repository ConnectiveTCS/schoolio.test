<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    DB::statement('SELECT 1 FROM assets LIMIT 1');
    echo "Assets table exists, dropping it...\n";
    DB::statement('DROP TABLE assets');
    echo "Assets table dropped successfully\n";
} catch (Exception $e) {
    echo "Assets table does not exist or error: " . $e->getMessage() . "\n";
}
