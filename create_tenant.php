<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->boot();

$tenant = App\Models\Tenant::create(['name' => 'Test School']);
echo "Tenant created with ID: " . $tenant->id . PHP_EOL;
