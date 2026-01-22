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

$shouldReset = in_array('--reset', $argv, true);
if ($shouldReset) {
    clearDirectory($storageDir);
    clearDirectory($publicDir);
    Package::query()->update(['gallery_images' => null]);
}

if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
}
if (!is_dir($publicDir)) {
    mkdir($publicDir, 0755, true);
}

$packages = Package::all();
$downloaded = 0;

foreach ($packages as $package) {
    $existing = $package->gallery_images;
    $galleryImages = is_array($existing) ? $existing : [];
    if (count($galleryImages) >= 3) {
        continue;
    }

    $keywords = buildKeywords($package->location, $package->name);
    $queries = buildDestinationQueries($package->location, $package->name, $keywords);
    $hashes = loadExistingHashes($galleryImages);
    $attempts = 0;
    $maxAttempts = 18;

    for ($i = count($galleryImages) + 1; $i <= 3; $i++) {
        $saved = false;
        $localIndex = 0;

        while (!$saved && $attempts < $maxAttempts) {
            $attempts++;
            $localIndex++;

            $query = $queries[$i - 1] ?? implode(',', $keywords);
            $url = buildImageUrl($query, $package->id, $i + $localIndex);
            $imageData = downloadImage($url);

            if ($imageData === null) {
                continue;
            }

            $hash = hash('sha256', $imageData);
            if (isset($hashes[$hash])) {
                continue;
            }

            $filename = Str::slug($package->name . '-' . $package->id) . '-' . $i . '.jpg';
            $relativePath = 'packages/gallery/' . $filename;
            $storagePath = $storageDir . DIRECTORY_SEPARATOR . $filename;
            $publicPath = $publicDir . DIRECTORY_SEPARATOR . $filename;

            file_put_contents($storagePath, $imageData);
            copy($storagePath, $publicPath);

            $galleryImages[] = $relativePath;
            $hashes[$hash] = true;
            $downloaded++;
            $saved = true;
        }
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

function buildImageUrl(string $query, int $packageId, int $index): string
{
    $lock = ($packageId * 10) + $index;
    $tags = implode(',', array_map('rawurlencode', explode(',', $query)));

    return "https://loremflickr.com/900/600/{$tags}?lock={$lock}";
}

function buildDestinationQueries(string $location, string $name, array $keywords): array
{
    $locationLower = strtolower($location);
    $nameLower = strtolower($name);

    $known = [
        'colombo' => [
            'colombo,city,sri-lanka',
            'colombo,temple,sri-lanka',
            'colombo,seaside,sri-lanka',
        ],
        'kandy' => [
            'kandy,temple,sri-lanka',
            'kandy,lake,sri-lanka',
            'kandy,hills,sri-lanka',
        ],
        'sigiriya' => [
            'sigiriya,rock,sri-lanka',
            'dambulla,cave,temple',
            'sigiriya,nature,sri-lanka',
        ],
        'dambulla' => [
            'dambulla,cave,temple',
            'sigiriya,rock,sri-lanka',
            'dambulla,nature,sri-lanka',
        ],
        'galle' => [
            'galle,fort,sri-lanka',
            'galle,beach,sri-lanka',
            'galle,lighthouse,sri-lanka',
        ],
        'bentota' => [
            'bentota,beach,sri-lanka',
            'bentota,coastline,sri-lanka',
            'bentota,ocean,sri-lanka',
        ],
        'ella' => [
            'ella,nine-arch-bridge,sri-lanka',
            'ella,tea-plantation,sri-lanka',
            'ella,mountain,sri-lanka',
        ],
        'jaffna' => [
            'jaffna,fort,sri-lanka',
            'jaffna,temple,sri-lanka',
            'jaffna,coastline,sri-lanka',
        ],
        'nuwara eliya' => [
            'nuwara-eliya,tea-plantation,sri-lanka',
            'nuwara-eliya,hills,sri-lanka',
            'nuwara-eliya,lake,sri-lanka',
        ],
        'yala' => [
            'yala,national-park,sri-lanka',
            'sri-lanka,leopard,safari',
            'sri-lanka,wildlife,safari',
        ],
        'udawalawe' => [
            'udawalawe,elephants,sri-lanka',
            'sri-lanka,elephant,safari',
            'udawalawe,national-park,sri-lanka',
        ],
        'anuradhapura' => [
            'anuradhapura,stupa,sri-lanka',
            'anuradhapura,ruins,sri-lanka',
            'anuradhapura,temple,sri-lanka',
        ],
        'polonnaruwa' => [
            'polonnaruwa,ruins,sri-lanka',
            'polonnaruwa,temple,sri-lanka',
            'polonnaruwa,ancient-city,sri-lanka',
        ],
    ];

    foreach ($known as $key => $queries) {
        if (str_contains($locationLower, $key) || str_contains($nameLower, $key)) {
            return $queries;
        }
    }

    $fallback = implode(',', array_slice($keywords, 0, 4));
    return [
        "{$fallback},sri-lanka,nature",
        "{$fallback},sri-lanka,landscape",
        "{$fallback},sri-lanka,travel",
    ];
}

function downloadImage(string $url): ?string
{
    $context = stream_context_create([
        'http' => [
            'timeout' => 12,
            'user_agent' => 'ThambapanniTravel/1.0'
        ]
    ]);

    $data = @file_get_contents($url, false, $context);

    if ($data === false) {
        return null;
    }

    return $data;
}

function loadExistingHashes(array $galleryImages): array
{
    $hashes = [];
    foreach ($galleryImages as $image) {
        if (!is_string($image)) {
            continue;
        }
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            continue;
        }
        $path = storage_path('app/public/' . ltrim($image, '/'));
        if (is_file($path)) {
            $hashes[hash_file('sha256', $path)] = true;
        }
    }

    return $hashes;
}

function clearDirectory(string $path): void
{
    if (!is_dir($path)) {
        return;
    }

    $items = array_diff(scandir($path), ['.', '..']);
    foreach ($items as $item) {
        $itemPath = $path . DIRECTORY_SEPARATOR . $item;
        if (is_dir($itemPath)) {
            clearDirectory($itemPath);
            rmdir($itemPath);
        } else {
            unlink($itemPath);
        }
    }
}
