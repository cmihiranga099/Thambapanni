<?php

namespace App\Console\Commands;

use App\Models\Package;
use Illuminate\Console\Command;

/**
 * UpdatePackageImages Command
 * 
 * This Artisan command updates all package images in the database with appropriate
 * nature photos of Sri Lanka. It provides a command-line interface for the same
 * functionality as the UpdatePackageImagesSeeder.
 * 
 * Usage: php artisan packages:update-images
 * 
 * Features:
 * - Maps packages to specific Sri Lankan nature images
 * - Supports wildlife, waterfalls, mountains, forests, rivers, lakes
 * - Fallback logic for packages without specific matches
 * - Comprehensive location and name-based matching
 * - Command-line progress reporting
 */
class UpdatePackageImages extends Command
{
    /**
     * The name and signature of the console command
     * 
     * @var string
     */
    protected $signature = 'packages:update-images';

    /**
     * The console command description
     * 
     * @var string
     */
    protected $description = 'Update package images with existing image files';

    /**
     * Execute the console command
     * 
     * This method is called when the command is executed. It:
     * 1. Retrieves all packages from the database
     * 2. Maps each package to an appropriate image
     * 3. Updates the package's image field
     * 4. Reports progress and results
     * 
     * @return int Command exit code (0 for success)
     */
    public function handle()
    {
        // Display start message to inform user of command execution
        $this->info('Updating package images...');

        // Retrieve all packages from the database
        $packages = Package::all();
        
        // Iterate through each package to update its image
        foreach ($packages as $package) {
            // Determine the appropriate image for this package
            $imageName = $this->getImageNameForPackage($package);
            
            if ($imageName) {
                // Update the package's image field with the new image path
                $package->update(['image' => 'packages/' . $imageName]);
                
                // Report successful update with package name and image
                $this->info("Updated {$package->name} with image: {$imageName}");
            } else {
                // Warn user if no suitable image found for a package
                $this->warn("No image found for {$package->name} - Location: {$package->location}");
            }
        }

        // Display completion message
        $this->info('Package images updated successfully!');
        
        // Return success exit code
        return 0;
    }

    /**
     * Determine the appropriate image for a package based on location and name
     * 
     * This method uses a priority-based matching system:
     * 1. Direct location matches (highest priority)
     * 2. Theme-based location matches
     * 3. Name-based matches
     * 4. Fallback matches
     * 5. Default nature image (lowest priority)
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
        
        // Colombo city packages - urban discovery and city life
        if (str_contains($location, 'colombo')) {
            return 'colombo-city-discovery.jpg';
        }
        
        // Kandy cultural packages - heritage sites and cultural experiences
        if (str_contains($location, 'kandy')) {
            return 'kandy-cultural-heritage.jpg';
        }
        
        // Sigiriya and Dambulla heritage sites - ancient rock fortress and cave temples
        if (str_contains($location, 'sigiriya') || str_contains($location, 'dambulla')) {
            return 'sigiriya-dambulla-heritage.jpg';
        }
        
        // Ella adventure and hiking packages - mountain trails and scenic views
        if (str_contains($location, 'ella')) {
            return 'ella-adventure-hiking.jpg';
        }
        
        // Galle fort and southern coast - colonial architecture and beaches
        if (str_contains($location, 'galle')) {
            return 'galle-fort-southern-beaches.jpg';
        }
        
        // Bentota beach paradise - pristine beaches and water activities
        if (str_contains($location, 'bentota')) {
            return 'bentota-beach-paradise.jpg';
        }
        
        // Jaffna northern cultural experience - northern heritage and culture
        if (str_contains($location, 'jaffna')) {
            return 'jaffna-cultural-experience.jpg';
        }
        
        // ========================================
        // THEME-BASED LOCATION MATCHES (Priority 2)
        // ========================================
        
        // Ancient cities and temple packages - historical and spiritual sites
        if (str_contains($location, 'ancient') || str_contains($location, 'temples')) {
            return 'ancient-cities-temples.jpg';
        }
        
        // Tea country and hill station packages - Nuwara Eliya and surrounding areas
        if (str_contains($location, 'tea') || str_contains($location, 'hill') || str_contains($location, 'nuwara eliya')) {
            return 'tea-country-hill-stations.jpg';
        }
        
        // Beach and coastal packages - Mirissa, Trincomalee, and other coastal areas
        if (str_contains($location, 'beach') || str_contains($location, 'coastal') || str_contains($location, 'mirissa') || str_contains($location, 'trincomalee')) {
            return 'bentota-beach-paradise.jpg';
        }
        
        // Fort and southern region packages - southern coastal fortifications
        if (str_contains($location, 'fort') || str_contains($location, 'southern')) {
            return 'galle-fort-southern-beaches.jpg';
        }
        
        // Adventure and hiking packages - outdoor activities and trekking
        if (str_contains($location, 'adventure') || str_contains($location, 'hiking') || str_contains($location, 'trekking')) {
            return 'ella-adventure-hiking.jpg';
        }
        
        // Northern region packages - northern cultural experiences
        if (str_contains($location, 'northern')) {
            return 'jaffna-cultural-experience.jpg';
        }
        
        // Heritage and cultural packages - cultural heritage sites
        if (str_contains($location, 'heritage') || str_contains($location, 'cultural')) {
            return 'ancient-cities-temples.jpg';
        }

        // ========================================
        // FALLBACK BASED ON PACKAGE NAME (Priority 3)
        // ========================================
        
        // City and discovery themed packages - urban exploration
        if (str_contains($name, 'city') || str_contains($name, 'discovery')) {
            return 'colombo-city-discovery.jpg';
        }
        
        // Heritage and cultural themed packages - cultural experiences
        if (str_contains($name, 'heritage') || str_contains($name, 'cultural')) {
            return 'kandy-cultural-heritage.jpg';
        }
        
        // Beach and paradise themed packages - coastal experiences
        if (str_contains($name, 'beach') || str_contains($name, 'paradise') || str_contains($name, 'coastal')) {
            return 'bentota-beach-paradise.jpg';
        }
        
        // Fort and southern themed packages - southern coastal experiences
        if (str_contains($name, 'fort') || str_contains($name, 'southern')) {
            return 'galle-fort-southern-beaches.jpg';
        }
        
        // Adventure and hiking themed packages - outdoor activities
        if (str_contains($name, 'adventure') || str_contains($name, 'hiking') || str_contains($name, 'trekking')) {
            return 'ella-adventure-hiking.jpg';
        }
        
        // Tea and hill station themed packages - hill country experiences
        if (str_contains($name, 'tea') || str_contains($name, 'hill') || str_contains($name, 'plantation')) {
            return 'tea-country-hill-stations.jpg';
        }
        
        // Ancient and temple themed packages - historical and spiritual experiences
        if (str_contains($name, 'ancient') || str_contains($name, 'temples')) {
            return 'ancient-cities-temples.jpg';
        }

        // ========================================
        // DEFAULT FALLBACK (Priority 4)
        // ========================================
        
        // If no specific match found, return null to indicate no match
        // This allows the calling method to handle the case appropriately
        return null;
    }
}
