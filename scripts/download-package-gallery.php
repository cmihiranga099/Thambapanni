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

$shouldReset = in_array('--reset', $argv, true);
if ($shouldReset) {
    Package::query()->update(['gallery_images' => null]);
}

$packages = Package::all();
$downloaded = 0;

foreach ($packages as $package) {
    $keywords = buildKeywords($package->location, $package->name);
    $galleryImages = [];
    $queries = buildDestinationQueries($package->location, $package->name, $keywords);

    for ($i = 1; $i <= 3; $i++) {
        $query = $queries[$i - 1] ?? implode(',', $keywords);
        $galleryImages[] = buildImageUrl($query, $package->id, $i);
    }

    if (!empty($galleryImages)) {
        $package->update(['gallery_images' => $galleryImages]);
    }
}

echo "Gallery URLs saved for packages.\n";

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

    $encodedQuery = rawurlencode($query);
    return "https://source.unsplash.com/1200x800/?{$encodedQuery}&sig={$lock}";
}

function buildDestinationQueries(string $location, string $name, array $keywords): array
{
    $locationLower = strtolower($location);
    $nameLower = strtolower($name);

    $known = [
        'colombo' => [
            'colombo sri lanka city skyline',
            'colombo sri lanka temple',
            'colombo sri lanka seaside',
        ],
        'kandy' => [
            'kandy sri lanka temple',
            'kandy lake sri lanka',
            'kandy sri lanka hills',
        ],
        'sigiriya' => [
            'sigiriya rock sri lanka',
            'dambulla cave temple sri lanka',
            'sigiriya sri lanka nature',
        ],
        'dambulla' => [
            'dambulla cave temple sri lanka',
            'sigiriya rock sri lanka',
            'dambulla sri lanka nature',
        ],
        'galle' => [
            'galle fort sri lanka',
            'galle sri lanka beach',
            'galle sri lanka lighthouse',
        ],
        'bentota' => [
            'bentota beach sri lanka',
            'bentota sri lanka coastline',
            'bentota sri lanka ocean',
        ],
        'ella' => [
            'ella sri lanka nine arch bridge',
            'ella sri lanka tea plantation',
            'ella sri lanka mountain',
        ],
        'jaffna' => [
            'jaffna fort sri lanka',
            'jaffna sri lanka temple',
            'jaffna sri lanka coastline',
        ],
        'nuwara eliya' => [
            'nuwara eliya sri lanka tea plantation',
            'nuwara eliya sri lanka hills',
            'nuwara eliya sri lanka lake',
        ],
        'yala' => [
            'yala national park sri lanka',
            'sri lanka leopard safari',
            'sri lanka wildlife safari',
        ],
        'udawalawe' => [
            'udawalawe sri lanka elephants',
            'sri lanka elephant safari',
            'udawalawe national park sri lanka',
        ],
        'anuradhapura' => [
            'anuradhapura sri lanka stupa',
            'anuradhapura sri lanka ruins',
            'anuradhapura sri lanka temple',
        ],
        'polonnaruwa' => [
            'polonnaruwa sri lanka ruins',
            'polonnaruwa sri lanka temple',
            'polonnaruwa sri lanka ancient city',
        ],
    ];

    foreach ($known as $key => $queries) {
        if (str_contains($locationLower, $key) || str_contains($nameLower, $key)) {
            return $queries;
        }
    }

    $fallback = implode(' ', array_slice($keywords, 0, 4));
    return [
        "{$fallback} sri lanka nature",
        "{$fallback} sri lanka landscape",
        "{$fallback} sri lanka travel",
    ];
}
