<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Switch to central database
config(['database.default' => 'sqlite']);

use App\Models\SupportTicket;

echo "=== ROUTE DEBUGGING ===\n";

$ticketId = 4;
$filename = '1756638870_68b42e96050d9_12.png';

echo "Looking for ticket ID: $ticketId\n";
echo "Looking for filename: $filename\n";
echo "URL decoded filename: " . urldecode($filename) . "\n";

$ticket = SupportTicket::with('replies')->find($ticketId);

if (!$ticket) {
    echo "❌ Ticket not found in central database\n";
    exit;
}

echo "✅ Ticket found: " . $ticket->title . "\n";
echo "Ticket has " . count($ticket->attachments ?? []) . " attachments\n";
echo "Ticket has " . $ticket->replies->count() . " replies\n";

// Simulate the exact logic from the controller
$found = false;

// Check in ticket attachments first
if ($ticket->attachments) {
    foreach ($ticket->attachments as $attachment) {
        echo "Checking ticket attachment: " . $attachment['filename'] . "\n";
        if ($attachment['filename'] === $filename) {
            $path = storage_path('app/public/' . $attachment['path']);
            echo "✅ Found in ticket attachments!\n";
            echo "Path: $path\n";
            echo "File exists: " . (file_exists($path) ? 'YES' : 'NO') . "\n";
            $found = true;
            break;
        }
    }
}

// Check in replies
if (!$found) {
    foreach ($ticket->replies as $reply) {
        if ($reply->attachments) {
            foreach ($reply->attachments as $attachment) {
                echo "Checking reply attachment: " . $attachment['filename'] . "\n";
                if ($attachment['filename'] === $filename) {
                    $path = storage_path('app/public/' . $attachment['path']);
                    echo "✅ Found in reply attachments!\n";
                    echo "Reply ID: " . $reply->id . "\n";
                    echo "Path: $path\n";
                    echo "File exists: " . (file_exists($path) ? 'YES' : 'NO') . "\n";
                    $found = true;
                    break 2;
                }
            }
        }
    }
}

if (!$found) {
    echo "❌ Attachment not found in any location\n";
}

// Let's also check the route URL generation
echo "\n=== URL TESTING ===\n";
echo "Expected URL: /central/support/$ticketId/download/$filename\n";

// Generate the route URL
try {
    $url = route('central.support.download', ['ticket' => $ticketId, 'filename' => $filename]);
    echo "Generated URL: $url\n";
} catch (Exception $e) {
    echo "Error generating URL: " . $e->getMessage() . "\n";
}
