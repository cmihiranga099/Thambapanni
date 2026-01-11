<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Travel Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-gradient-to-r from-blue-600 to-green-600 text-white">
                    <h1 class="text-3xl font-bold mb-2">Discover Sri Lanka</h1>
                    <p class="text-xl text-blue-100">Explore our curated collection of amazing travel experiences</p>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <form method="GET" action="{{ route('customer.packages') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Packages</label>
                                <input type="text" id="search" name="search" value="{{ request('search') }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Search by name, location...">
                            </div>
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <select id="location" name="location" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Locations</option>
                                    <option value="Colombo" {{ request('location') == 'Colombo' ? 'selected' : '' }}>Colombo</option>
                                    <option value="Kandy" {{ request('location') == 'Kandy' ? 'selected' : '' }}>Kandy</option>
                                    <option value="Sigiriya" {{ request('location') == 'Sigiriya' ? 'selected' : '' }}>Sigiriya</option>
                                    <option value="Galle" {{ request('location') == 'Galle' ? 'selected' : '' }}>Galle</option>
                                    <option value="Nuwara Eliya" {{ request('location') == 'Nuwara Eliya' ? 'selected' : '' }}>Nuwara Eliya</option>
                                    <option value="Yala" {{ request('location') == 'Yala' ? 'selected' : '' }}>Yala</option>
                                </select>
                            </div>
                            <div>
                                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                                <select id="duration" name="duration" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Durations</option>
                                    <option value="1 Day" {{ request('duration') == '1 Day' ? 'selected' : '' }}>1 Day</option>
                                    <option value="2 Days" {{ request('duration') == '2 Days' ? 'selected' : '' }}>2 Days</option>
                                    <option value="3 Days" {{ request('duration') == '3 Days' ? 'selected' : '' }}>3 Days</option>
                                    <option value="4 Days" {{ request('duration') == '4 Days' ? 'selected' : '' }}>4 Days</option>
                                </select>
                            </div>
                            <div>
                                <label for="price_range" class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                                <select id="price_range" name="price_range" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Prices</option>
                                    <option value="0-100" {{ request('price_range') == '0-100' ? 'selected' : '' }}>Under $100</option>
                                    <option value="100-200" {{ request('price_range') == '100-200' ? 'selected' : '' }}>$100 - $200</option>
                                    <option value="200-300" {{ request('price_range') == '200-300' ? 'selected' : '' }}>$200 - $300</option>
                                    <option value="300+" {{ request('price_range') == '300+' ? 'selected' : '' }}>Over $300</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-[1.02] shadow-sm">
                                Apply Filters
                            </button>
                            <a href="{{ route('customer.packages') }}" 
                                class="text-gray-600 hover:text-gray-800 text-sm font-medium hover:underline transition duration-200">
                                Clear All Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results Info -->
            @if(request()->hasAny(['search', 'location', 'duration', 'price_range']))
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>{{ $packages->total() }}</strong> package(s) found
                                @if(request('search'))
                                    for "<strong>{{ request('search') }}</strong>"
                                @endif
                                @if(request('location'))
                                    in <strong>{{ request('location') }}</strong>
                                @endif
                                @if(request('duration'))
                                    with <strong>{{ request('duration') }}</strong> duration
                                @endif
                                @if(request('price_range'))
                                    in <strong>${{ str_replace('-', ' - $', request('price_range')) }}</strong> price range
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Packages Grid -->
            @if($packages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($packages as $package)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:scale-105">
                        <!-- Package Image -->
                        @if($package->image)
                            <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $package->image) }}')">
                                <div class="h-full w-full bg-black bg-opacity-30 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold text-shadow-lg">{{ $package->location }}</span>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center">
                                <span class="text-white text-2xl font-bold">{{ $package->location }}</span>
                            </div>
                        @endif

                        <!-- Package Content -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $package->name }}</h3>
                                <span class="text-sm text-gray-500">{{ $package->duration }}</span>
                            </div>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($package->description, 120) }}</p>
                            
                            <!-- Highlights -->
                            @if($package->highlights && count($package->highlights) > 0)
                            <div class="mb-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach(array_slice($package->highlights, 0, 3) as $highlight)
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $highlight }}</span>
                                    @endforeach
                                    @if(count($package->highlights) > 3)
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">+{{ count($package->highlights) - 3 }} more</span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Package Details -->
                            <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700">Location:</span>
                                    <p class="text-gray-600">{{ $package->location }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Max Travelers:</span>
                                    <p class="text-gray-600">{{ $package->max_travelers }}</p>
                                </div>
                            </div>

                            <!-- Price and Action -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-3xl font-bold text-blue-600">${{ number_format($package->price, 2) }}</span>
                                    <span class="text-sm text-gray-500">per person</span>
                                </div>
                                <div class="space-y-2">
                                    <a href="{{ route('customer.packages.show', $package) }}" 
                                        class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center py-2.5 px-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-[1.02] shadow-sm text-sm font-medium">
                                        View Details
                                    </a>
                                    <a href="{{ route('customer.packages.book', $package) }}" 
                                        class="block w-full bg-gradient-to-r from-green-600 to-green-700 text-white text-center py-2.5 px-4 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-[1.02] shadow-sm text-sm font-medium">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $packages->links() }}
                </div>
            @else
                <!-- No Packages Found -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No packages found</h3>
                        <p class="text-gray-500 mb-6">Try adjusting your search criteria or check back later for new packages.</p>
                        <a href="{{ route('customer.packages') }}" 
                            class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-[1.02] shadow-sm">
                            View All Packages
                        </a>
                    </div>
                </div>
            @endif

            <!-- Why Choose Us -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Why Choose Thambapanni Travel?</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 mb-2">Local Expertise</h4>
                            <p class="text-sm text-gray-600">Our team knows every corner of Sri Lanka and will show you the hidden gems.</p>
                        </div>

                        <div class="text-center">
                            <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 mb-2">Quality Service</h4>
                            <p class="text-sm text-gray-600">We ensure the highest quality service with comfortable accommodations.</p>
                        </div>

                        <div class="text-center">
                            <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 mb-2">Unforgettable Memories</h4>
                            <p class="text-sm text-gray-600">Create lasting memories with our carefully curated experiences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
