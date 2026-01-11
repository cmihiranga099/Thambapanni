<?php

/**
 * Download Sample Images for Thambapanni Travel Packages
 * 
 * This script downloads sample images from Unsplash for development/testing purposes.
 * For production use, ensure you have proper licensing for all images.
 */

// Create packages directory if it doesn't exist
$packagesDir = __DIR__ . '/../public/storage/packages';
if (!is_dir($packagesDir)) {
    mkdir($packagesDir, 0755, true);
    echo "Created packages directory: {$packagesDir}\n";
}

// Sample image URLs from Unsplash (free to use)
$sampleImages = [
    'colombo-city-discovery.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'kandy-cultural-heritage.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'sigiriya-dambulla-heritage.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'galle-fort-southern-beaches.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'tea-country-hill-stations.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'wildlife-safari-adventure.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'ancient-cities-temples.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'bentota-beach-paradise.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'ella-adventure-hiking.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    'jaffna-cultural-experience.jpg' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
];

echo "🌴 Thambapanni Travel - Image Download Script\n";
echo "==============================================\n\n";

echo "Downloading sample images for your travel packages...\n\n";

$successCount = 0;
$errorCount = 0;

foreach ($sampleImages as $filename => $url) {
    $filepath = $packagesDir . '/' . $filename;
    
    echo "Downloading {$filename}... ";
    
    try {
        // Download image
        $imageContent = file_get_contents($url);
        
        if ($imageContent !== false) {
            // Save image
            if (file_put_contents($filepath, $imageContent) !== false) {
                echo "✅ Success\n";
                $successCount++;
            } else {
                echo "❌ Failed to save file\n";
                $errorCount++;
            }
        } else {
            echo "❌ Failed to download\n";
            $errorCount++;
        }
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
        $errorCount++;
    }
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "Download Summary:\n";
echo "✅ Successful: {$successCount}\n";
echo "❌ Failed: {$errorCount}\n";
echo "📁 Total: " . count($sampleImages) . "\n\n";

if ($successCount > 0) {
    echo "🎉 Great! Some images were downloaded successfully.\n";
    echo "📝 Note: These are sample images. For production, use properly licensed images.\n\n";
    
    echo "Next steps:\n";
    echo "1. Check the downloaded images in: {$packagesDir}\n";
    echo "2. Refresh your database: php artisan migrate:fresh --seed\n";
    echo "3. Build assets: npm run build\n";
    echo "4. Visit your homepage to see the beautiful package images!\n";
} else {
    echo "⚠️  No images were downloaded. This might be due to:\n";
    echo "- Network connectivity issues\n";
    echo "- URL restrictions\n";
    echo "- File permissions\n\n";
    
    echo "Alternative solutions:\n";
    echo "1. Manually download images from Unsplash using the search terms in README.md\n";
    echo "2. Use the image checklist: public/storage/packages/image-checklist.html\n";
    echo "3. Check the documentation for manual image setup instructions\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "Script completed.\n";
