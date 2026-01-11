<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Package;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);

        // Create permissions
        $permissions = [
            'view_packages',
            'create_packages',
            'edit_packages',
            'delete_packages',
            'view_bookings',
            'manage_bookings',
            'view_customers',
            'view_reports',
            'view_contacts',
            'manage_contacts',
            'book_packages',
            'view_own_bookings',
            'cancel_bookings'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $customerRole->givePermissionTo([
            'view_packages',
            'book_packages',
            'view_own_bookings',
            'cancel_bookings'
        ]);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@thambapanni.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $admin->assignRole('admin');

        // Create sample customer
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $customer->assignRole('customer');

        // Create sample packages
        $packages = [
            [
                'name' => 'Colombo City Discovery',
                'description' => 'Experience the vibrant capital city of Sri Lanka with our comprehensive city tour. Visit ancient temples, colonial architecture, modern attractions, and immerse yourself in the local culture and cuisine.',
                'duration' => '1 Day',
                'price' => 85.00,
                'location' => 'Colombo',
                'image' => 'colombo-city-discovery.jpg',
                'highlights' => ['Gangaramaya Temple', 'Independence Square', 'Galle Face Green', 'National Museum', 'Viharamahadevi Park'],
                'itinerary' => [
                    '09:00 AM - Hotel Pickup & Welcome',
                    '09:30 AM - Gangaramaya Temple Visit',
                    '11:00 AM - Independence Square & Architecture',
                    '12:30 PM - Traditional Sri Lankan Lunch',
                    '02:00 PM - National Museum & Art Gallery',
                    '04:00 PM - Galle Face Green Sunset',
                    '06:00 PM - Return to Hotel'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Professional Guide', 'Traditional Lunch', 'Entrance Fees', 'Refreshments'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Activities'],
                'max_travelers' => 15,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Kandy Cultural Heritage',
                'description' => 'Immerse yourself in the rich cultural heritage of Kandy, the last capital of the Sinhala kings. Visit the sacred Temple of the Tooth Relic, experience traditional dance performances, and explore the beautiful hill country.',
                'duration' => '2 Days',
                'price' => 180.00,
                'location' => 'Kandy',
                'image' => 'kandy-cultural-heritage.jpg',
                'highlights' => ['Temple of the Sacred Tooth Relic', 'Traditional Kandyan Dance', 'Royal Botanical Gardens', 'Kandy Lake', 'Peradeniya University'],
                'itinerary' => [
                    'Day 1: Temple Visit, Cultural Show, City Tour',
                    'Day 2: Botanical Gardens, Tea Factory, Return Journey'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Expert Guide', 'Hotel Accommodation', 'All Meals', 'Entrance Fees', 'Cultural Show'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Activities'],
                'max_travelers' => 12,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Sigiriya & Dambulla Heritage',
                'description' => 'Climb the magnificent ancient rock fortress of Sigiriya, a UNESCO World Heritage site, and explore the stunning cave temples of Dambulla. Experience the perfect blend of adventure, history, and breathtaking views.',
                'duration' => '1 Day',
                'price' => 140.00,
                'location' => 'Sigiriya & Dambulla',
                'image' => 'sigiriya-dambulla-heritage.jpg',
                'highlights' => ['Sigiriya Rock Fortress', 'Dambulla Cave Temple', 'Pidurangala Rock', 'Local Village Experience', 'Sunset Views'],
                'itinerary' => [
                    '06:00 AM - Early Morning Start',
                    '07:30 AM - Sigiriya Rock Climb',
                    '11:00 AM - Traditional Village Lunch',
                    '01:00 PM - Dambulla Cave Temple',
                    '03:30 PM - Pidurangala Rock Hike',
                    '05:30 PM - Sunset & Return Journey'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Expert Guide', 'Traditional Lunch', 'Entrance Fees', 'Water & Snacks'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Activities'],
                'max_travelers' => 10,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Galle Fort & Southern Beaches',
                'description' => 'Discover the colonial charm of Galle Fort, a UNESCO World Heritage site, and enjoy the pristine beaches of the south coast. Perfect for history enthusiasts and beach lovers seeking authentic experiences.',
                'duration' => '3 Days',
                'price' => 320.00,
                'location' => 'Galle & Southern Coast',
                'image' => 'galle-fort-southern-beaches.jpg',
                'highlights' => ['Galle Fort Exploration', 'Unawatuna Beach', 'Mirissa Whale Watching', 'Dutch Museum', 'Local Fishing Village'],
                'itinerary' => [
                    'Day 1: Galle Fort, Lighthouse, Dutch Museum',
                    'Day 2: Beach Activities, Whale Watching, Sunset',
                    'Day 3: Local Villages, Spice Garden, Return'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Expert Guide', 'Beach Hotel Accommodation', 'All Meals', 'Whale Watching', 'Activities'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Water Sports'],
                'max_travelers' => 8,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Tea Country & Hill Stations',
                'description' => 'Experience the cool climate and breathtaking beauty of Sri Lanka\'s hill country. Visit world-famous tea plantations, trek through Horton Plains, and enjoy the serene mountain landscapes of Nuwara Eliya.',
                'duration' => '4 Days',
                'price' => 420.00,
                'location' => 'Nuwara Eliya & Hill Country',
                'image' => 'tea-country-hill-stations.jpg',
                'highlights' => ['Tea Plantations & Factory', 'Horton Plains National Park', 'World\'s End Viewpoint', 'Victoria Park', 'Gregory Lake', 'Waterfall Visits'],
                'itinerary' => [
                    'Day 1: Arrival, City Tour, Victoria Park',
                    'Day 2: Tea Plantations, Factory Tour, Tasting',
                    'Day 3: Horton Plains Trek, World\'s End',
                    'Day 4: Leisure Activities, Return Journey'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Expert Guide', 'Mountain Hotel Accommodation', 'All Meals', 'Tea Factory Tour', 'National Park Fees'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Activities'],
                'max_travelers' => 10,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Wildlife Safari Adventure',
                'description' => 'Embark on an exciting wildlife safari in Yala National Park, home to the highest density of leopards in the world. Spot elephants, leopards, crocodiles, and hundreds of bird species in their natural habitat.',
                'duration' => '2 Days',
                'price' => 280.00,
                'location' => 'Yala National Park',
                'image' => 'wildlife-safari-adventure.jpg',
                'highlights' => ['Yala National Park Safari', 'Leopard Spotting', 'Bird Watching', 'Nature Walks', 'Camping Experience', 'Sunrise Safari'],
                'itinerary' => [
                    'Day 1: Morning Safari, Afternoon Safari, Camping',
                    'Day 2: Early Morning Safari, Nature Walk, Return'
                ],
                'inclusions' => ['Safari Jeep Transport', 'Expert Wildlife Guide', 'Camping Accommodation', 'All Meals', 'Safari Fees', 'Park Permits'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Camera Fees', 'Optional Activities'],
                'max_travelers' => 6,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Ancient Cities & Temples',
                'description' => 'Journey through the ancient cities of Anuradhapura and Polonnaruwa, exploring magnificent temples, stupas, and ruins that tell the story of Sri Lanka\'s glorious past as a Buddhist kingdom.',
                'duration' => '3 Days',
                'price' => 260.00,
                'location' => 'Cultural Triangle',
                'image' => 'ancient-cities-temples.jpg',
                'highlights' => ['Anuradhapura Sacred City', 'Polonnaruwa Ruins', 'Mihintale Sacred Mountain', 'Isurumuniya Temple', 'Archaeological Museum'],
                'itinerary' => [
                    'Day 1: Anuradhapura Sacred City Tour',
                    'Day 2: Polonnaruwa Ancient City',
                    'Day 3: Mihintale, Local Villages, Return'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Expert Guide', 'Hotel Accommodation', 'All Meals', 'Entrance Fees', 'Local Experiences'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Activities'],
                'max_travelers' => 12,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Bentota Beach Paradise',
                'description' => 'Relax in the tropical paradise of Bentota, known for its pristine beaches, water sports, and luxury resorts. Enjoy water activities, spa treatments, and the perfect beach holiday experience.',
                'duration' => '3 Days',
                'price' => 380.00,
                'location' => 'Bentota & Kalutara',
                'image' => 'bentota-beach-paradise.jpg',
                'highlights' => ['Bentota Beach', 'Water Sports Activities', 'River Safari', 'Spa & Wellness', 'Sunset Cruises', 'Local Markets'],
                'itinerary' => [
                    'Day 1: Beach Arrival, Water Sports, Sunset',
                    'Day 2: River Safari, Spa Treatment, Beach Activities',
                    'Day 3: Local Markets, Leisure, Return'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Beach Resort Accommodation', 'All Meals', 'Water Sports Equipment', 'Spa Session', 'River Safari'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Premium Activities'],
                'max_travelers' => 8,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Ella Adventure & Hiking',
                'description' => 'Experience the adventure capital of Sri Lanka with hiking trails, stunning viewpoints, and the famous Nine Arch Bridge. Perfect for nature lovers and adventure seekers.',
                'duration' => '2 Days',
                'price' => 200.00,
                'location' => 'Ella & Uva Province',
                'image' => 'ella-adventure-hiking.jpg',
                'highlights' => ['Little Adam\'s Peak Hike', 'Nine Arch Bridge', 'Ella Rock Trek', 'Ravana Falls', 'Tea Factory Visit', 'Mountain Views'],
                'itinerary' => [
                    'Day 1: Little Adam\'s Peak, Nine Arch Bridge, Sunset',
                    'Day 2: Ella Rock Trek, Waterfalls, Return'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Expert Guide', 'Mountain Lodge Accommodation', 'All Meals', 'Hiking Equipment', 'Local Guide'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Activities'],
                'max_travelers' => 8,
                'min_travelers' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Jaffna Cultural Experience',
                'description' => 'Discover the unique culture and heritage of Jaffna, the northern capital of Sri Lanka. Experience Tamil culture, visit ancient temples, and enjoy authentic northern cuisine.',
                'duration' => '3 Days',
                'price' => 300.00,
                'location' => 'Jaffna & Northern Province',
                'image' => 'jaffna-cultural-experience.jpg',
                'highlights' => ['Jaffna Fort', 'Nallur Kandaswamy Temple', 'Jaffna Library', 'Local Markets', 'Island Hopping', 'Traditional Cuisine'],
                'itinerary' => [
                    'Day 1: Jaffna Fort, Temple Visit, Local Markets',
                    'Day 2: Island Hopping, Beach Visit, Cultural Show',
                    'Day 3: Library Visit, Local Villages, Return'
                ],
                'inclusions' => ['Air-conditioned Transport', 'Expert Guide', 'Hotel Accommodation', 'All Meals', 'Cultural Activities', 'Local Experiences'],
                'exclusions' => ['Personal Expenses', 'Tips', 'Optional Activities'],
                'max_travelers' => 10,
                'min_travelers' => 2,
                'is_active' => true
            ]
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }

        // Create sample contact
        Contact::create([
            'name' => 'Sample Contact',
            'email' => 'contact@example.com',
            'phone' => '+94 77 987 6543',
            'subject' => 'General Inquiry',
            'message' => 'This is a sample contact message for testing purposes.',
            'status' => 'new'
        ]);
    }
}
