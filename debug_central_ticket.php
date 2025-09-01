<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Switch to central database context
config(['database.default' => 'sqlite']);

use App\Models\SupportTicket;

try {
    $ticket = SupportTicket::with('replies')->find(4);

    if ($ticket) {
        echo "=== CENTRAL TICKET 4 DEBUG ===\n";
        echo "ID: " . $ticket->id . "\n";
        echo "Title: " . $ticket->title . "\n";
        echo "Attachments: " . json_encode($ticket->attachments) . "\n";
        echo "Attachments count: " . count($ticket->attachments ?? []) . "\n";

        if ($ticket->attachments) {
            echo "\n--- Ticket Attachments ---\n";
            foreach ($ticket->attachments as $index => $attachment) {
                echo "[$index] Filename: " . $attachment['filename'] . "\n";
                echo "[$index] Original: " . $attachment['original_name'] . "\n";
                echo "[$index] Path: " . $attachment['path'] . "\n";
                $fullPath = storage_path('app/public/' . $attachment['path']);
                echo "[$index] Full path: " . $fullPath . "\n";
                echo "[$index] File exists: " . (file_exists($fullPath) ? 'YES' : 'NO') . "\n";
                echo "\n";
            }
        }

        echo "\n--- Replies ---\n";
        foreach ($ticket->replies as $reply) {
            echo "Reply ID: " . $reply->id . "\n";
            echo "Reply Attachments: " . json_encode($reply->attachments) . "\n";

            if ($reply->attachments) {
                foreach ($reply->attachments as $index => $attachment) {
                    echo "  [$index] Filename: " . $attachment['filename'] . "\n";
                    echo "  [$index] Original: " . $attachment['original_name'] . "\n";
                    echo "  [$index] Path: " . $attachment['path'] . "\n";
                    $fullPath = storage_path('app/public/' . $attachment['path']);
                    echo "  [$index] Full path: " . $fullPath . "\n";
                    echo "  [$index] File exists: " . (file_exists($fullPath) ? 'YES' : 'NO') . "\n";
                    echo "\n";
                }
            }
        }

        // Check for the specific file mentioned in the error
        $searchFilename = '1756638870_68b42e96050d9_12.png';
        echo "\n=== SEARCHING FOR: $searchFilename ===\n";

        $found = false;
        if ($ticket->attachments) {
            foreach ($ticket->attachments as $attachment) {
                if ($attachment['filename'] === $searchFilename) {
                    echo "✅ Found in ticket attachments!\n";
                    $found = true;
                    break;
                }
            }
        }

        if (!$found) {
            foreach ($ticket->replies as $reply) {
                if ($reply->attachments) {
                    foreach ($reply->attachments as $attachment) {
                        if ($attachment['filename'] === $searchFilename) {
                            echo "✅ Found in reply attachments!\n";
                            $found = true;
                            break 2;
                        }
                    }
                }
            }
        }

        if (!$found) {
            echo "❌ File $searchFilename not found in any attachments\n";
        }
    } else {
        echo "Ticket with ID 4 not found in central database.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
