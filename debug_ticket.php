<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database/database.sqlite',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Get support ticket with ID 4
$ticket = Capsule::table('support_tickets')->where('id', 4)->first();

if ($ticket) {
    echo "Ticket ID: " . $ticket->id . "\n";
    echo "Ticket Number: " . $ticket->ticket_number . "\n";
    echo "Title: " . $ticket->title . "\n";
    echo "Attachments: " . ($ticket->attachments ?? 'NULL') . "\n";
    echo "Attachments type: " . gettype($ticket->attachments) . "\n";
    echo "Attachments empty: " . (empty($ticket->attachments) ? 'YES' : 'NO') . "\n";
} else {
    echo "No ticket found with ID 4\n";
}

// Also check replies for this ticket
echo "\n--- Replies for ticket 4 ---\n";
$replies = Capsule::table('support_ticket_replies')->where('support_ticket_id', 4)->get();

foreach ($replies as $reply) {
    echo "Reply ID: " . $reply->id . "\n";
    echo "Message: " . substr($reply->message, 0, 50) . "...\n";
    echo "Attachments: " . ($reply->attachments ?? 'NULL') . "\n";
    echo "Sender type: " . $reply->sender_type . "\n";
    echo "---\n";
}

// Check if the specific file exists
$filename = '1756638371_68b42ca3b07e0_2 (2).png';
echo "\n--- Looking for file: $filename ---\n";

// Check all replies for this filename
foreach ($replies as $reply) {
    if ($reply->attachments) {
        $attachments = json_decode($reply->attachments, true);
        if ($attachments) {
            foreach ($attachments as $attachment) {
                if ($attachment['filename'] === $filename) {
                    echo "Found in reply {$reply->id}!\n";
                    echo "Path: " . $attachment['path'] . "\n";
                    echo "File exists: " . (file_exists(__DIR__ . '/storage/app/public/' . $attachment['path']) ? 'YES' : 'NO') . "\n";
                }
            }
        }
    }
}
