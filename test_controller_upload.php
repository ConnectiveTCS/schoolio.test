<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing the exact controller file upload logic...\n";

try {
    // Simulate the controller logic
    $originalName = "test_attachment.txt";
    $filename = time() . '_' . uniqid() . '_' . $originalName;
    $tenantId = 1; // Simulating tenant('id')

    echo "Original name: $originalName\n";
    echo "Generated filename: $filename\n";
    echo "Tenant ID: $tenantId\n";

    // Ensure the directory exists (this is the new logic we added)
    $directory = "tenant_{$tenantId}/support_tickets";
    echo "Directory: $directory\n";

    if (!Storage::disk('public')->exists($directory)) {
        echo "Creating directory...\n";
        Storage::disk('public')->makeDirectory($directory);
    } else {
        echo "Directory already exists\n";
    }

    // Create a test file to upload
    $testContent = "This is test attachment content";
    $tempFile = tempnam(sys_get_temp_dir(), 'attachment_test');
    file_put_contents($tempFile, $testContent);

    // Create an UploadedFile (simulating $file from request)
    $uploadedFile = new \Illuminate\Http\UploadedFile(
        $tempFile,
        $originalName,
        'text/plain',
        null,
        true // test mode
    );

    echo "Created UploadedFile instance\n";
    echo "File size: " . $uploadedFile->getSize() . " bytes\n";
    echo "MIME type: " . $uploadedFile->getMimeType() . "\n";

    // This is the exact line from our controller
    $path = $uploadedFile->storeAs($directory, $filename, 'public');

    echo "storeAs returned: " . var_export($path, true) . "\n";

    if ($path) {
        echo "✅ File upload successful!\n";

        // Build the attachment array (as in controller)
        $attachment = [
            'original_name' => $originalName,
            'filename' => $filename,
            'path' => $path,
            'size' => $uploadedFile->getSize(),
            'mime_type' => $uploadedFile->getMimeType(),
        ];

        echo "Attachment data: " . json_encode($attachment, JSON_PRETTY_PRINT) . "\n";

        // Verify file exists
        if (Storage::disk('public')->exists($path)) {
            echo "✅ File verified to exist in storage\n";
        } else {
            echo "❌ File does not exist in storage\n";
        }

        // Check filesystem
        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            echo "✅ File exists on filesystem: $fullPath\n";
        } else {
            echo "❌ File missing from filesystem: $fullPath\n";
        }
    } else {
        echo "❌ File upload failed\n";
        Log::error('Failed to store attachment', ['filename' => $filename]);
    }

    // Clean up
    unlink($tempFile);
} catch (\Exception $e) {
    echo "❌ Exception occurred: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nTest completed.\n";
