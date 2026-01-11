<?php

/**
 * Sample Image Download Script for Thambapanni Travel
 * 
 * This script helps download sample images for travel packages.
 * Note: This is for development/testing purposes only.
 * For production, use properly licensed images.
 */

// Create packages directory if it doesn't exist
$packagesDir = __DIR__ . '/../public/storage/packages';
if (!is_dir($packagesDir)) {
    mkdir($packagesDir, 0755, true);
}

// Sample image URLs (these are placeholder URLs - replace with actual image URLs)
$sampleImages = [
    'colombo-city-discovery.jpg' => 'https://example.com/colombo-city.jpg',
    'kandy-cultural-heritage.jpg' => 'https://example.com/kandy-temple.jpg',
    'sigiriya-dambulla-heritage.jpg' => 'https://example.com/sigiriya-rock.jpg',
    'galle-fort-southern-beaches.jpg' => 'https://example.com/galle-fort.jpg',
    'tea-country-hill-stations.jpg' => 'https://example.com/tea-plantations.jpg',
    'wildlife-safari-adventure.jpg' => 'https://example.com/yala-safari.jpg',
    'ancient-cities-temples.jpg' => 'https://example.com/ancient-ruins.jpg',
    'bentota-beach-paradise.jpg' => 'https://example.com/bentota-beach.jpg',
    'ella-adventure-hiking.jpg' => 'https://example.com/ella-hiking.jpg',
    'jaffna-cultural-experience.jpg' => 'https://example.com/jaffna-fort.jpg'
];

echo "Thambapanni Travel - Sample Image Download Script\n";
echo "================================================\n\n";

echo "This script will help you download sample images for your travel packages.\n";
echo "IMPORTANT: Replace the placeholder URLs with actual image URLs before running.\n\n";

echo "Required Images:\n";
foreach ($sampleImages as $filename => $url) {
    echo "- {$filename}\n";
}

echo "\nTo use this script:\n";
echo "1. Replace the placeholder URLs with actual image URLs\n";
echo "2. Run: php scripts/download-sample-images.php\n";
echo "3. Or manually download images and place them in public/storage/packages/\n\n";

echo "Alternative: Use stock photo websites like:\n";
echo "- Unsplash (unsplash.com)\n";
echo "- Pexels (pexels.com)\n";
echo "- Pixabay (pixabay.com)\n";
echo "- Shutterstock (shutterstock.com)\n\n";

echo "Search terms for each destination:\n";
echo "- Colombo: 'Colombo Sri Lanka city', 'Gangaramaya Temple'\n";
echo "- Kandy: 'Kandy Sri Lanka', 'Temple of the Tooth Relic'\n";
echo "- Sigiriya: 'Sigiriya Rock Fortress', 'Dambulla Cave Temple'\n";
echo "- Galle: 'Galle Fort Sri Lanka', 'Unawatuna Beach'\n";
echo "- Tea Country: 'Nuwara Eliya tea plantations', 'Sri Lanka hill country'\n";
echo "- Wildlife: 'Yala National Park', 'Sri Lanka wildlife safari'\n";
echo "- Ancient Cities: 'Anuradhapura Sri Lanka', 'Polonnaruwa ruins'\n";
echo "- Bentota: 'Bentota Beach Sri Lanka', 'Sri Lanka beaches'\n";
echo "- Ella: 'Ella Sri Lanka hiking', 'Nine Arch Bridge'\n";
echo "- Jaffna: 'Jaffna Fort Sri Lanka', 'Jaffna temple'\n\n";

echo "Image Requirements:\n";
echo "- Format: JPG or PNG\n";
echo "- Size: Minimum 800x600px\n";
echo "- Quality: High resolution\n";
echo "- Content: Representative of each destination\n\n";

echo "After adding images, refresh your database:\n";
echo "php artisan migrate:fresh --seed\n\n";

echo "Script completed. Please add your actual images manually.\n";
