<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-3 sm:space-y-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                {{ __('Travel Packages') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 sm:mb-8">
                <div class="p-4 sm:p-6">
                    <form method="GET" action="{{ route('packages') }}" class="space-y-4 sm:space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Packages</label>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Package name, location, or description..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Location Filter -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <select id="location" name="location" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Locations</option>
                                    @if(isset($locations))
                                        @foreach($locations as $location)
                                            <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                                {{ $location }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div>
                                <label for="min_price" class="block text-sm font-medium text-gray-700 mb-2">Min Price</label>
                                <input type="number" 
                                       id="min_price" 
                                       name="min_price" 
                                       value="{{ request('min_price') }}"
                                       placeholder="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="max_price" class="block text-sm font-medium text-gray-700 mb-2">Max Price</label>
                                <input type="number" 
                                       id="max_price" 
                                       name="max_price" 
                                       value="{{ request('max_price') }}"
                                       placeholder="1000"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700 transition duration-300">
                                Apply Filters
                            </button>
                            <a href="{{ route('packages') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-gray-600 transition duration-300 text-center">
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results Info -->
            @if(request()->hasAny(['search', 'location', 'min_price', 'max_price']))
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
                                @if(request('min_price') || request('max_price'))
                                    @if(request('min_price') && request('max_price'))
                                        between <strong>${{ request('min_price') }} - ${{ request('max_price') }}</strong>
                                    @elseif(request('min_price'))
                                        from <strong>${{ request('min_price') }}</strong>
                                    @else
                                        up to <strong>${{ request('max_price') }}</strong>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Packages Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @forelse($packages as $package)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300">
                        <!-- Package Image -->
                        @if($package->image)
                            <div class="h-48 sm:h-56 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $package->image) }}')">
                                <div class="h-full w-full bg-black bg-opacity-30 flex items-center justify-center">
                                    <span class="text-white font-bold text-lg sm:text-xl">{{ $package->location }}</span>
                                </div>
                            </div>
                        @else
                            <div class="h-48 sm:h-56 bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center">
                                <span class="text-white font-bold text-lg sm:text-xl">{{ $package->location }}</span>
                            </div>
                        @endif

                        <!-- Package Content -->
                        <div class="p-4 sm:p-6">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">{{ $package->name }}</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">{{ Str::limit($package->description, 100) }}</p>
                            
                            <!-- Package Details -->
                            <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700">Duration:</span>
                                    <p class="text-gray-600">{{ $package->duration }}</p>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Price:</span>
                                    <p class="text-blue-600 font-bold">${{ number_format($package->price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                <a href="{{ route('packages.show', $package) }}" 
                                   class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                                    View Details
                                </a>
                                @auth
                                    <a href="{{ route('customer.packages.book', $package) }}" 
                                       class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                                        Book Now
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                                        Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="bg-gray-100 rounded-full w-16 h-16 sm:w-24 sm:h-24 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-medium text-gray-900 mb-2">No packages found</h3>
                        <p class="text-sm sm:text-base text-gray-500">Try adjusting your search criteria or check back later for new packages.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($packages->hasPages())
                <div class="mt-8">
                    {{ $packages->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Real-time search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('form');
            const searchInput = document.getElementById('search');

            // Auto-submit form when Enter is pressed in search field
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchForm.submit();
                }
            });

            // Clear search highlight
            function clearSearch() {
                document.getElementById('search').value = '';
                document.getElementById('location').value = '';
                document.getElementById('min_price').value = '';
                document.getElementById('max_price').value = '';
                window.location.href = '{{ route("packages") }}';
            }

            // Add clear button functionality if exists
            const clearBtn = document.querySelector('a[href="{{ route("packages") }}"]');
            if (clearBtn) {
                clearBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    clearSearch();
                });
            }
        });
    </script>
</x-app-layout>

