<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

/**
 * UpdatePackageImagesSeeder
 * 
 * This seeder updates all package images in the database with appropriate
 * nature photos of Sri Lanka. It maps packages to images based on their
 * location and name, prioritizing nature and wildlife themes.
 * 
 * Features:
 * - Maps packages to specific Sri Lankan nature images
 * - Supports wildlife, waterfalls, mountains, forests, rivers, lakes
 * - Fallback logic for packages without specific matches
 * - Comprehensive location and name-based matching
 */
class UpdatePackageImagesSeeder extends Seeder
{
    /**
     * Run the seeder
     * 
     * Iterates through all packages and updates their image field
     * with appropriate nature photos based on location and name matching
     */
    public function run()
    {
        // Display start message
        $this->command->info('Updating package images with nature photos of Sri Lanka...');

        // Get all packages from the database
        $packages = Package::all();
        
        // Loop through each package and update its image
        foreach ($packages as $package) {
            // Get the appropriate image name for this package
            $imageName = $this->getImageNameForPackage($package);
            
            if ($imageName) {
                // Update the package with the new image path
                $package->update(['image' => 'packages/' . $imageName]);
                $this->command->info("Updated {$package->name} with image: {$imageName}");
            } else {
                // Warn if no suitable image found
                $this->command->warn("No image found for {$package->name} - Location: {$package->location}");
            }
        }

        // Display completion message
        $this->command->info('Package images updated successfully with nature photos!');
    }

    /**
     * Determine the appropriate image for a package based on location and name
     * 
     * @param Package $package The package to find an image for
     * @return string|null The image filename or null if no match found
     */
    private function getImageNameForPackage($package)
    {
        // Convert location and name to lowercase for case-insensitive matching
        $location = strtolower($package->location);
        $name = strtolower($package->name);
        
        // ========================================
        // DIRECT LOCATION MATCHES (Priority 1)
        // ========================================
        
        // Colombo city packages
        if (str_contains($location, 'colombo')) {
            return 'colombo-city-discovery.jpg';
        }
        
        // Kandy cultural packages
        if (str_contains($location, 'kandy')) {
            return 'kandy-cultural-heritage.jpg';
        }
        
        // Sigiriya and Dambulla heritage sites
        if (str_contains($location, 'sigiriya') || str_contains($location, 'dambulla')) {
            return 'sigiriya-dambulla-heritage.jpg';
        }
        
        // Ella adventure and hiking packages
        if (str_contains($location, 'ella')) {
            return 'ella-adventure-hiking.jpg';
        }
        
        // Galle fort and southern coast
        if (str_contains($location, 'galle')) {
            return 'galle-fort-southern-beaches.jpg';
        }
        
        // Bentota beach paradise
        if (str_contains($location, 'bentota')) {
            return 'bentota-beach-paradise.jpg';
        }
        
        // Jaffna northern cultural experience
        if (str_contains($location, 'jaffna')) {
            return 'jaffna-cultural-experience.jpg';
        }
        
        // ========================================
        // NATURE AND WILDLIFE FOCUSED MATCHES (Priority 2)
        // ========================================
        
        // Wildlife safari packages (Yala, Udawalawe, etc.)
        if (str_contains($location, 'wildlife') || str_contains($location, 'safari') || str_contains($location, 'yala') || str_contains($location, 'udawalawe')) {
            return 'wildlife-safari-adventure.jpg';
        }
        
        // Waterfall packages (Bambarakanda, Ravana, Devon Falls)
        if (str_contains($location, 'waterfall') || str_contains($location, 'bambarakanda') || str_contains($location, 'ravana') || str_contains($location, 'devon')) {
            return 'waterfalls-nature.jpg';
        }
        
        // Mountain and peak packages (Adam's Peak, Knuckles Range)
        if (str_contains($location, 'mountain') || str_contains($location, 'peak') || str_contains($location, 'adam') || str_contains($location, 'knuckles')) {
            return 'mountain-peaks-nature.jpg';
        }
        
        // Forest and rainforest packages (Sinharaja Rainforest)
        if (str_contains($location, 'forest') || str_contains($location, 'rainforest') || str_contains($location, 'sinharaja')) {
            return 'rainforest-nature.jpg';
        }
        
        // River packages (Mahaweli, Kelani rivers)
        if (str_contains($location, 'river') || str_contains($location, 'mahaweli') || str_contains($location, 'kelani')) {
            return 'rivers-nature.jpg';
        }
        
        // Lake and garden packages (Botanical Gardens, Peradeniya)
        if (str_contains($location, 'lake') || str_contains($location, 'garden') || str_contains($location, 'botanical')) {
            return 'lakes-gardens-nature.jpg';
        }
        
        // ========================================
        // THEME-BASED LOCATION MATCHES (Priority 3)
        // ========================================
        
        // Ancient cities and temple packages
        if (str_contains($location, 'ancient') || str_contains($location, 'temples')) {
            return 'ancient-cities-temples.jpg';
        }
        
        // Tea country and hill station packages (Nuwara Eliya)
        if (str_contains($location, 'tea') || str_contains($location, 'hill') || str_contains($location, 'nuwara eliya')) {
            return 'tea-country-hill-stations.jpg';
        }
        
        // Beach and coastal packages (Mirissa, Trincomalee)
        if (str_contains($location, 'beach') || str_contains($location, 'coastal') || str_contains($location, 'mirissa') || str_contains($location, 'trincomalee')) {
            return 'bentota-beach-paradise.jpg';
        }
        
        // Fort and southern region packages
        if (str_contains($location, 'fort') || str_contains($location, 'southern')) {
            return 'galle-fort-southern-beaches.jpg';
        }
        
        // Adventure and hiking packages
        if (str_contains($location, 'adventure') || str_contains($location, 'hiking') || str_contains($location, 'trekking')) {
            return 'ella-adventure-hiking.jpg';
        }
        
        // Northern region packages
        if (str_contains($location, 'northern')) {
            return 'jaffna-cultural-experience.jpg';
        }
        
        // Heritage and cultural packages
        if (str_contains($location, 'heritage') || str_contains($location, 'cultural')) {
            return 'ancient-cities-temples.jpg';
        }

        // ========================================
        // FALLBACK BASED ON PACKAGE NAME (Priority 4)
        // ========================================
        
        // Wildlife and safari themed packages
        if (str_contains($name, 'wildlife') || str_contains($name, 'safari') || str_contains($name, 'elephant') || str_contains($name, 'leopard')) {
            return 'wildlife-safari-adventure.jpg';
        }
        
        // Waterfall and nature themed packages
        if (str_contains($name, 'waterfall') || str_contains($name, 'nature') || str_contains($name, 'scenic')) {
            return 'waterfalls-nature.jpg';
        }
        
        // Mountain and peak themed packages
        if (str_contains($name, 'mountain') || str_contains($name, 'peak') || str_contains($name, 'climbing')) {
            return 'mountain-peaks-nature.jpg';
        }
        
        // Forest and rainforest themed packages
        if (str_contains($name, 'forest') || str_contains($name, 'rainforest') || str_contains($name, 'jungle')) {
            return 'rainforest-nature.jpg';
        }
        
        // River and water sports packages
        if (str_contains($name, 'river') || str_contains($name, 'rafting') || str_contains($name, 'kayaking')) {
            return 'rivers-nature.jpg';
        }
        
        // Lake and garden themed packages
        if (str_contains($name, 'lake') || str_contains($name, 'garden') || str_contains($name, 'botanical')) {
            return 'lakes-gardens-nature.jpg';
        }
        
        // City and discovery themed packages
        if (str_contains($name, 'city') || str_contains($name, 'discovery')) {
            return 'colombo-city-discovery.jpg';
        }
        
        // Heritage and cultural themed packages
        if (str_contains($name, 'heritage') || str_contains($name, 'cultural')) {
            return 'kandy-cultural-heritage.jpg';
        }
        
        // Beach and paradise themed packages
        if (str_contains($name, 'beach') || str_contains($name, 'paradise') || str_contains($name, 'coastal')) {
            return 'bentota-beach-paradise.jpg';
        }
        
        // Fort and southern themed packages
        if (str_contains($name, 'fort') || str_contains($name, 'southern')) {
            return 'galle-fort-southern-beaches.jpg';
        }
        
        // Adventure and hiking themed packages
        if (str_contains($name, 'adventure') || str_contains($name, 'hiking') || str_contains($name, 'trekking')) {
            return 'ella-adventure-hiking.jpg';
        }
        
        // Tea and hill station themed packages
        if (str_contains($name, 'tea') || str_contains($name, 'hill') || str_contains($name, 'plantation')) {
            return 'tea-country-hill-stations.jpg';
        }
        
        // Ancient and temple themed packages
        if (str_contains($name, 'ancient') || str_contains($name, 'temples')) {
            return 'ancient-cities-temples.jpg';
        }

        // ========================================
        // DEFAULT FALLBACK (Priority 5)
        // ========================================
        
        // If no specific match found, default to a nature image
        return 'waterfalls-nature.jpg';
    }
}
