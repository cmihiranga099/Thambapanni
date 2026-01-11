<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sri Lanka Travel Packages') }}
        </h2>
    </x-slot>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-green-600 text-white">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Discover Sri Lanka Packages
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    From ancient temples to pristine beaches, explore our carefully curated travel packages
                </p>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Search packages..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="flex gap-2">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Locations</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Sigiriya">Sigiriya</option>
                        <option value="Galle">Galle</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Yala">Yala</option>
                    </select>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">All Durations</option>
                        <option value="1 Day">1 Day</option>
                        <option value="2 Days">2 Days</option>
                        <option value="3 Days">3 Days</option>
                        <option value="4 Days">4 Days</option>
                        <option value="5+ Days">5+ Days</option>
                    </select>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Price Range</option>
                        <option value="0-100">$0 - $100</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200-300">$200 - $300</option>
                        <option value="300+">$300+</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Packages Grid -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Available Packages</h2>
                <p class="text-gray-600">Showing {{ $packages->count() }} packages</p>
            </div>

            @if($packages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($packages as $package)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        @if($package->image)
                            <div class="h-48 bg-cover bg-center relative overflow-hidden" style="background-image: url('{{ asset('storage/' . $package->image) }}')">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <span class="text-white text-xl font-bold drop-shadow-lg">{{ $package->location }}</span>
                                </div>
                                @if($package->is_active)
                                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Active</span>
                                @endif
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center relative">
                                <span class="text-white text-2xl font-bold">{{ $package->location }}</span>
                                @if($package->is_active)
                                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Active</span>
                                @endif
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $package->name }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($package->description, 120) }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-blue-600">${{ number_format($package->price, 2) }}</span>
                                <span class="text-gray-500">{{ $package->duration }}</span>
                            </div>

                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(array_slice($package->highlights ?? [], 0, 3) as $highlight)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $highlight }}</span>
                                @endforeach
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-sm text-gray-500 mb-4">
                                <div>
                                    <span class="font-medium">Max Travelers:</span> {{ $package->max_travelers }}
                                </div>
                                <div>
                                    <span class="font-medium">Min Travelers:</span> {{ $package->min_travelers }}
                                </div>
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('packages.show', $package) }}" class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                                    View Details
                                </a>
                                @auth
                                    @if(auth()->user()->isCustomer())
                                    <a href="{{ route('customer.packages.book', $package) }}" class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                                        Book Now
                                    </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                                        Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $packages->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No packages found</h3>
                    <p class="text-gray-500">Try adjusting your search criteria or check back later for new packages.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Package Categories -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Package Categories</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Explore different types of experiences available in Sri Lanka
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group cursor-pointer">
                    <div class="bg-yellow-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-200 transition duration-300">
                        <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Cultural Tours</h3>
                    <p class="text-gray-600">Discover ancient temples, historical sites, and traditional culture</p>
                </div>

                <div class="text-center group cursor-pointer">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition duration-300">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Adventure Tours</h3>
                    <p class="text-gray-600">Hiking, wildlife safaris, and outdoor adventures</p>
                </div>

                <div class="text-center group cursor-pointer">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition duration-300">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Beach Holidays</h3>
                    <p class="text-gray-600">Relax on pristine beaches and enjoy coastal activities</p>
                </div>

                <div class="text-center group cursor-pointer">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition duration-300">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Wellness Retreats</h3>
                    <p class="text-gray-600">Yoga, meditation, and wellness experiences</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-16 bg-gradient-to-r from-blue-600 to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Need Help Choosing a Package?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Our travel experts are here to help you find the perfect Sri Lanka experience
            </p>
            <div class="space-x-4">
                <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                    Contact Our Experts
                </a>
                <a href="{{ route('home') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 inline-block">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
