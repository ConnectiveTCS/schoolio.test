<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test different storage methods
$testContent = "This is a test file content for storage testing";
$filename = time() . '_' . uniqid() . '_test_file.txt';
$directory = "tenant_1/support_tickets";

echo "Testing different storage methods...\n";

try {
    // Method 1: Using put method (what I used in test above)
    echo "\n=== Testing Storage::put ===\n";
    $path1 = Storage::disk('public')->put($directory . '/' . $filename, $testContent);
    echo "Storage::put returned: " . var_export($path1, true) . "\n";

    // Method 2: Using putFileAs with temporary file (similar to storeAs)
    echo "\n=== Testing with temporary file ===\n";

    // Create a temporary file
    $tempFile = tempnam(sys_get_temp_dir(), 'test_upload');
    file_put_contents($tempFile, $testContent);

    // Create an UploadedFile instance
    $uploadedFile = new UploadedFile(
        $tempFile,
        'test_file.txt',
        'text/plain',
        null,
        true // Test mode
    );

    $filename2 = time() . '_' . uniqid() . '_test_file2.txt';
    $path2 = $uploadedFile->storeAs($directory, $filename2, 'public');
    echo "storeAs returned: " . var_export($path2, true) . "\n";

    // Check if file exists
    if (Storage::disk('public')->exists($path2)) {
        echo "✅ File created with storeAs exists in storage\n";
    } else {
        echo "❌ File created with storeAs does not exist in storage\n";
    }

    // Check filesystem
    $fullPath2 = storage_path('app/public/' . $path2);
    echo "Expected filesystem path: $fullPath2\n";

    if (file_exists($fullPath2)) {
        echo "✅ File exists on filesystem\n";
        echo "File size: " . filesize($fullPath2) . " bytes\n";
    } else {
        echo "❌ File does not exist on filesystem\n";
    }

    // Clean up
    unlink($tempFile);
} catch (Exception $e) {
    echo "❌ Error during test: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nDone.\n";
