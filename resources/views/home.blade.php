<x-app-layout>
    <!-- Hero Section -->
    <div class="relative min-h-screen bg-blue-600 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32">
            <div class="text-center">
                <div class="mb-6 sm:mb-8">
                    <div class="inline-flex items-center px-3 sm:px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm rounded-full border border-white border-opacity-30 mb-4 sm:mb-6">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white text-xs sm:text-sm font-medium">Trusted by 10,000+ Travelers</span>
                    </div>
                </div>
                
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 sm:mb-8 text-white leading-tight">
                    Discover the Magic of
                    <span class="block text-yellow-300">
                        Sri Lanka
                    </span>
                </h1>
                
                <p class="text-lg sm:text-xl md:text-2xl mb-8 sm:mb-12 max-w-4xl mx-auto text-blue-100 leading-relaxed px-4">
                    Experience ancient temples, pristine beaches, lush tea plantations, and incredible wildlife in this tropical paradise. Your adventure begins here.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center px-4">
                    <a href="{{ route('packages') }}" class="group bg-white text-blue-600 px-6 sm:px-8 lg:px-10 py-3 sm:py-4 rounded-md font-bold text-base sm:text-lg shadow-lg hover:shadow-blue-500/25 transition-all duration-300 inline-flex items-center w-full sm:w-auto justify-center">
                        <svg class="w-5 sm:w-6 h-5 sm:h-6 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Explore Packages
                    </a>
                    <a href="{{ route('contact') }}" class="group border-2 border-white text-white px-6 sm:px-8 lg:px-10 py-3 sm:py-4 rounded-md font-bold text-base sm:text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 inline-flex items-center backdrop-blur-sm w-full sm:w-auto justify-center">
                        <svg class="w-5 sm:w-6 h-5 sm:h-6 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Contact Us
                    </a>
                </div>
                
                <!-- Scroll Indicator -->
                <div class="absolute bottom-4 sm:bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 sm:py-20 lg:py-24 bg-white relative">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-50 to-white"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <div class="inline-flex items-center px-3 sm:px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                    <svg class="w-3 sm:w-4 h-3 sm:h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Why Choose Us
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">Why Choose Thambapanni Travel?</h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    We provide authentic Sri Lankan experiences with local expertise, quality service, and unforgettable memories that last a lifetime
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 lg:gap-12">
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 sm:w-20 h-16 sm:h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Local Expertise</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Our team of local experts knows every corner of Sri Lanka and will show you the hidden gems that most tourists never discover.</p>
                </div>

                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 sm:w-20 h-16 sm:h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Quality Service</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">We ensure the highest quality service with comfortable accommodations, reliable transportation, and personalized attention to detail.</p>
                </div>

                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-yellow-500 to-orange-500 w-16 sm:w-20 h-16 sm:h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Unforgettable Memories</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Create lasting memories with our carefully curated experiences and authentic cultural encounters that will stay with you forever.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Packages Section -->
    <div class="py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-gray-50 to-blue-50 relative">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23e5e7eb" fill-opacity="0.3"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <div class="inline-flex items-center px-3 sm:px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                    <svg class="w-3 sm:w-4 h-3 sm:h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Popular Packages
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">Featured Packages</h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    Discover our most popular Sri Lanka travel packages designed to give you the best experience of this beautiful island
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @if(isset($featuredPackages) && $featuredPackages->count() > 0)
                    @foreach($featuredPackages as $package)
                <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 border border-gray-100">
                    @if($package->image)
                        <div class="h-48 sm:h-56 bg-cover bg-center relative overflow-hidden" style="background-image: url('{{ asset('storage/' . $package->image) }}')">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 right-3 sm:right-4">
                                <span class="text-white text-lg sm:text-xl font-bold drop-shadow-lg">{{ $package->location }}</span>
                            </div>
                            <div class="absolute top-3 sm:top-4 right-3 sm:right-4">
                                <span class="bg-white/90 text-gray-800 px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-semibold">{{ $package->duration }}</span>
                            </div>
                        </div>
                    @else
                        <div class="h-48 sm:h-56 bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center relative overflow-hidden">
                            <span class="text-white text-lg sm:text-xl font-bold drop-shadow-lg">{{ $package->location }}</span>
                            <div class="absolute top-3 sm:top-4 right-3 sm:right-4">
                                <span class="bg-white/90 text-gray-800 px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-semibold">{{ $package->duration }}</span>
                            </div>
                        </div>
                    @endif
                    
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3 group-hover:text-blue-600 transition-colors duration-300">{{ $package->name }}</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 leading-relaxed line-clamp-3">{{ Str::limit($package->description, 120) }}</p>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2 sm:gap-0">
                            <div>
                                <span class="text-2xl sm:text-3xl font-bold text-blue-600">${{ number_format($package->price, 2) }}</span>
                                <span class="text-gray-500 text-xs sm:text-sm">per person</span>
                            </div>
                            <div class="text-left sm:text-right">
                                <div class="flex items-center text-yellow-500 mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 sm:w-4 h-3 sm:h-4 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-500 text-xs sm:text-sm">4.8 (120 reviews)</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-1 sm:gap-2 mb-4 sm:mb-6">
                            @foreach(array_slice($package->highlights ?? [], 0, 3) as $highlight)
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 sm:px-3 py-1 rounded-full font-medium">{{ $highlight }}</span>
                            @endforeach
                        </div>
                        
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                            <a href="{{ route('packages.show', $package) }}" class="flex-1 bg-gray-100 text-gray-700 text-center py-2 sm:py-3 px-3 sm:px-4 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 group-hover:bg-blue-600 group-hover:text-white text-sm sm:text-base">
                                View Details
                            </a>
                            @auth
                                @if(auth()->user()->isCustomer())
                                <a href="{{ route('customer.packages.book', $package) }}" class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white text-center py-2 sm:py-3 px-3 sm:px-4 rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-lg hover:shadow-xl text-sm sm:text-base">
                                    Book Now
                                </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                
                @if(!isset($featuredPackages) || $featuredPackages->count() == 0)
                <!-- No Featured Packages Available -->
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Featured Packages Available</h3>
                    <p class="text-gray-600 mb-6">We're currently updating our featured packages. Check back soon!</p>
                    <a href="{{ route('packages') }}" 
                       class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        Browse All Packages
                    </a>
                </div>
                @endif
            </div>

            <div class="text-center mt-12 sm:mt-16">
                <a href="{{ route('packages') }}" class="group bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 sm:px-12 py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg shadow-xl hover:shadow-2xl hover:shadow-blue-500/25 hover:scale-105 transition-all duration-300 inline-flex items-center">
                    <span>View All Packages</span>
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Sri Lanka Highlights Section -->
    <div class="py-16 sm:py-20 lg:py-24 bg-white relative">
        <div class="absolute inset-0 bg-gradient-to-b from-white to-gray-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <div class="inline-flex items-center px-3 sm:px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                    <svg class="w-3 sm:w-4 h-3 sm:h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    Must-See Attractions
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">Sri Lanka Highlights</h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                    From ancient temples to pristine beaches, discover what makes Sri Lanka truly special and unforgettable
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-yellow-400 to-orange-500 w-20 sm:w-24 h-20 sm:h-24 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Ancient Temples</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Discover centuries-old Buddhist temples and sacred sites that tell the story of Sri Lanka's rich spiritual heritage.</p>
                </div>

                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-400 to-blue-600 w-20 sm:w-24 h-20 sm:h-24 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Tea Plantations</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Experience the world-famous Ceylon tea in the misty hill country with breathtaking views and authentic tea experiences.</p>
                </div>

                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-green-400 to-green-600 w-20 sm:w-24 h-20 sm:h-24 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Wildlife Safari</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Spot majestic elephants, elusive leopards, and exotic birds in pristine national parks and wildlife sanctuaries.</p>
                </div>

                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-gradient-to-br from-purple-400 to-purple-600 w-20 sm:w-24 h-20 sm:h-24 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Pristine Beaches</h3>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed px-2">Relax on beautiful beaches with crystal clear waters, golden sands, and stunning sunsets that will take your breath away.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-blue-600 via-blue-700 to-green-600 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-6 sm:mb-8">
                <div class="inline-flex items-center px-3 sm:px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm rounded-full border border-white border-opacity-30 mb-4 sm:mb-6">
                    <svg class="w-4 sm:w-5 h-4 sm:h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="text-white text-xs sm:text-sm font-medium">Limited Time Offers</span>
                </div>
            </div>
            
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6">Ready to Start Your Sri Lanka Adventure?</h2>
            <p class="text-base sm:text-lg lg:text-xl mb-8 sm:mb-12 max-w-3xl mx-auto text-blue-100 leading-relaxed px-4">
                Join thousands of travelers who have discovered the magic of Sri Lanka with us. Your dream vacation is just a click away!
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center px-4">
                <a href="{{ route('packages') }}" class="group bg-white text-blue-600 px-8 sm:px-12 py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg shadow-2xl hover:shadow-blue-500/25 hover:scale-105 transition-all duration-300 inline-flex items-center w-full sm:w-auto justify-center">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Browse Packages
                </a>
                <a href="{{ route('contact') }}" class="group border-2 border-white text-white px-8 sm:px-12 py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg hover:bg-white hover:text-blue-600 hover:scale-105 transition-all duration-300 inline-flex items-center backdrop-blur-sm w-full sm:w-auto justify-center">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Get in Touch
                </a>
            </div>
            
            <!-- Trust Indicators -->
            <div class="mt-12 sm:mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">10,000+</div>
                    <div class="text-blue-100 text-sm sm:text-base">Happy Travelers</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">500+</div>
                    <div class="text-blue-100 text-sm sm:text-base">Successful Trips</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">4.9/5</div>
                    <div class="text-blue-100 text-sm sm:text-base">Customer Rating</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cookie Consent Banner -->
    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50 transform translate-y-full transition-transform duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-gray-900">Cookie Notice</span>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                        We use cookies to enhance your browsing experience, serve personalized content, and analyze our traffic. 
                        By clicking "Accept All", you consent to our use of cookies. 
                        <a href="#" class="text-blue-600 hover:text-blue-800 underline">Learn more</a>
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full sm:w-auto">
                    <button id="cookie-accept-all" class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200 w-full sm:w-auto">
                        Accept All
                    </button>
                    <button id="cookie-accept-essential" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs sm:text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200 w-full sm:w-auto">
                        Essential Only
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cookie Consent JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cookieBanner = document.getElementById('cookie-banner');
            const acceptAllBtn = document.getElementById('cookie-accept-all');
            const acceptEssentialBtn = document.getElementById('cookie-accept-essential');
            
            // Check if user has already made a choice
            if (!localStorage.getItem('cookieConsent')) {
                // Show banner after a short delay
                setTimeout(() => {
                    cookieBanner.classList.remove('translate-y-full');
                }, 1000);
            }
            
            // Accept all cookies
            acceptAllBtn.addEventListener('click', function() {
                localStorage.setItem('cookieConsent', 'all');
                hideBanner();
                // Here you can add code to enable all cookies/analytics
            });
            
            // Accept essential cookies only
            acceptEssentialBtn.addEventListener('click', function() {
                localStorage.setItem('cookieConsent', 'essential');
                hideBanner();
                // Here you can add code to enable only essential cookies
            });
            
            function hideBanner() {
                cookieBanner.classList.add('translate-y-full');
                // Remove banner from DOM after animation
                setTimeout(() => {
                    cookieBanner.remove();
                }, 300);
            }
        });
    </script>
</x-app-layout>
