<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Initialize tenant context (we need to use tenant 1 based on the log)
$tenant = \App\Models\Tenant::find(1);
if ($tenant) {
    tenancy()->initialize($tenant);
    echo "=== TENANT TICKET ATTACHMENTS DEBUG (Tenant: {$tenant->name}) ===\n";
} else {
    echo "Tenant not found!\n";
    exit;
}

use App\Models\TenantSupportTicket;

$tickets = TenantSupportTicket::all();

foreach ($tickets as $ticket) {
    echo "\n--- Ticket #{$ticket->id} ({$ticket->ticket_number}) ---\n";
    echo "Title: {$ticket->title}\n";
    echo "Attachments: " . json_encode($ticket->attachments) . "\n";

    if ($ticket->attachments) {
        foreach ($ticket->attachments as $index => $attachment) {
            echo "[$index] Filename: " . $attachment['filename'] . "\n";
            echo "[$index] Original: " . $attachment['original_name'] . "\n";
            echo "[$index] Path: " . $attachment['path'] . "\n";

            $fullPath = storage_path('app/public/' . $attachment['path']);
            echo "[$index] Full path: " . $fullPath . "\n";
            echo "[$index] File exists: " . (file_exists($fullPath) ? 'YES' : 'NO') . "\n";

            // Check if directory exists
            $directory = dirname($fullPath);
            echo "[$index] Directory: " . $directory . "\n";
            echo "[$index] Directory exists: " . (is_dir($directory) ? 'YES' : 'NO') . "\n";
            echo "\n";
        }
    } else {
        echo "No attachments found.\n";
    }
}

echo "\n=== STORAGE DIRECTORY STRUCTURE ===\n";
$publicPath = storage_path('app/public');
echo "Public storage path: $publicPath\n";

if (is_dir($publicPath)) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($publicPath));
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            echo "File: " . $file->getPathname() . "\n";
        }
    }
} else {
    echo "Public storage directory does not exist!\n";
}
