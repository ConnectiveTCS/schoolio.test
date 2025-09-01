<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Storage;

// Mock a file upload to test the storage process
$testContent = "This is a test file content for storage testing";
$filename = time() . '_' . uniqid() . '_test_file.txt';
$directory = "tenant_1/support_tickets";

echo "Testing file storage...\n";
echo "Directory: $directory\n";
echo "Filename: $filename\n";
echo "Content length: " . strlen($testContent) . " bytes\n";

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    // Ensure the directory exists
    if (!Storage::disk('public')->exists($directory)) {
        echo "Creating directory: $directory\n";
        Storage::disk('public')->makeDirectory($directory);
    }

    // Store the file
    $path = Storage::disk('public')->put($directory . '/' . $filename, $testContent);

    if ($path) {
        echo "✅ File stored successfully at: $path\n";

        // Verify the file exists
        if (Storage::disk('public')->exists($path)) {
            echo "✅ File verified to exist in storage\n";

            // Check the actual file content
            $retrievedContent = Storage::disk('public')->get($path);
            if ($retrievedContent === $testContent) {
                echo "✅ File content matches original\n";
            } else {
                echo "❌ File content does not match\n";
            }
        } else {
            echo "❌ File does not exist in storage after creation\n";
        }
    } else {
        echo "❌ Failed to store file\n";
    }

    // Check actual filesystem
    $fullPath = storage_path('app/public/' . $directory . '/' . $filename);
    echo "Expected filesystem path: $fullPath\n";

    if (file_exists($fullPath)) {
        echo "✅ File exists on filesystem\n";
        echo "File size: " . filesize($fullPath) . " bytes\n";
    } else {
        echo "❌ File does not exist on filesystem\n";
    }
} catch (Exception $e) {
    echo "❌ Error during test: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nDone.\n";
