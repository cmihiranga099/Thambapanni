<?php

/**
 * Download gallery images for packages and store them locally.
 *
 * Usage:
 *   php scripts/download-package-gallery.php
 */

use App\Models\Package;
use Illuminate\Support\Str;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$storageDir = storage_path('app/public/packages/gallery');
$publicDir = public_path('storage/packages/gallery');

if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
}
if (!is_dir($publicDir)) {
    mkdir($publicDir, 0755, true);
}

$packages = Package::all();
$downloaded = 0;

foreach ($packages as $package) {
    $keywords = buildKeywords($package->location, $package->name);
    $slug = Str::slug($package->name . '-' . $package->id);
    $galleryImages = [];

    for ($i = 1; $i <= 3; $i++) {
        $filename = $slug . '-' . $i . '.jpg';
        $relativePath = 'packages/gallery/' . $filename;
        $storagePath = $storageDir . DIRECTORY_SEPARATOR . $filename;
        $publicPath = $publicDir . DIRECTORY_SEPARATOR . $filename;

        $url = buildImageUrl($keywords, $package->id, $i);
        $imageData = downloadImage($url);

        if ($imageData === null) {
            continue;
        }

        file_put_contents($storagePath, $imageData);
        copy($storagePath, $publicPath);

        $galleryImages[] = $relativePath;
        $downloaded++;
    }

    if (!empty($galleryImages)) {
        $package->update(['gallery_images' => $galleryImages]);
    }
}

echo "Gallery download complete. Images saved: {$downloaded}\n";

function buildKeywords(string $location, string $name): array
{
    $keywords = [];
    $locationTokens = preg_split('/[^a-zA-Z0-9]+/', strtolower($location));
    $nameTokens = preg_split('/[^a-zA-Z0-9]+/', strtolower($name));

    foreach (array_merge($locationTokens, $nameTokens) as $token) {
        if ($token !== '') {
            $keywords[] = $token;
        }
    }

    $keywords[] = 'sri-lanka';
    $keywords[] = 'nature';

    if (in_array('safari', $keywords, true) || in_array('wildlife', $keywords, true)) {
        $keywords[] = 'leopard';
    }
    if (in_array('beach', $keywords, true)) {
        $keywords[] = 'beach';
    }
    if (in_array('tea', $keywords, true) || in_array('plantation', $keywords, true)) {
        $keywords[] = 'tea-plantation';
    }
    if (in_array('temple', $keywords, true) || in_array('cultural', $keywords, true)) {
        $keywords[] = 'temple';
    }
    if (in_array('fort', $keywords, true)) {
        $keywords[] = 'fort';
    }
    if (in_array('mountain', $keywords, true) || in_array('hiking', $keywords, true)) {
        $keywords[] = 'mountain';
    }

    return array_values(array_unique($keywords));
}

function buildImageUrl(array $keywords, int $packageId, int $index): string
{
    $tags = implode(',', array_slice($keywords, 0, 6));
    $lock = ($packageId * 10) + $index;

    return "https://loremflickr.com/1200/800/{$tags}?lock={$lock}";
}

function downloadImage(string $url): ?string
{
    $context = stream_context_create([
        'http' => [
            'timeout' => 30,
            'user_agent' => 'ThambapanniTravel/1.0'
        ]
    ]);

    $data = @file_get_contents($url, false, $context);

    if ($data === false) {
        return null;
    }

    return $data;
}
