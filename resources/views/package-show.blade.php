<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $package->name }}
        </h2>
    </x-slot>

    <!-- Package Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-green-600 text-white">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $package->name }}</h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">{{ $package->location }}</p>
                <div class="flex justify-center space-x-8 text-lg">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $package->duration }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Max {{ $package->max_travelers }} travelers
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Package Details -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Description -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Package</h2>
                        <p class="text-gray-600 leading-relaxed">{{ $package->description }}</p>
                    </div>

                    <!-- Highlights -->
                    @if($package->highlights && count($package->highlights) > 0)
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Highlights</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($package->highlights as $highlight)
                            <div class="flex items-center space-x-3">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700">{{ $highlight }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Itinerary -->
                    @if($package->itinerary && count($package->itinerary) > 0)
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Itinerary</h2>
                        <div class="space-y-4">
                            @foreach($package->itinerary as $index => $item)
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-semibold flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-700">{{ $item }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Inclusions & Exclusions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @if($package->inclusions && count($package->inclusions) > 0)
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">What's Included</h2>
                            <ul class="space-y-3">
                                @foreach($package->inclusions as $inclusion)
                                <li class="flex items-center space-x-3">
                                    <div class="bg-green-100 p-1 rounded-full">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700">{{ $inclusion }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($package->exclusions && count($package->exclusions) > 0)
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">What's Not Included</h2>
                            <ul class="space-y-3">
                                @foreach($package->exclusions as $exclusion)
                                <li class="flex items-center space-x-3">
                                    <div class="bg-red-100 p-1 rounded-full">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700">{{ $exclusion }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <!-- Important Information -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Important Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Group Size</h3>
                                <p class="text-gray-600">Minimum: {{ $package->min_travelers }} travelers<br>Maximum: {{ $package->max_travelers }} travelers</p>
                            </div>
                            @if($package->departure_date)
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Departure Date</h3>
                                <p class="text-gray-600">{{ $package->departure_date->format('F j, Y') }}</p>
                            </div>
                            @endif
                            @if($package->return_date)
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Return Date</h3>
                                <p class="text-gray-600">{{ $package->return_date->format('F j, Y') }}</p>
                            </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Status</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $package->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $package->is_active ? 'Available' : 'Not Available' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Price Card -->
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-6">
                        <div class="text-center mb-6">
                            <div class="text-4xl font-bold text-blue-600 mb-2">${{ number_format($package->price, 2) }}</div>
                            <div class="text-gray-500">per person</div>
                        </div>

                        @if($package->is_active)
                            @auth
                                @if(auth()->user()->isCustomer())
                                <a href="{{ route('customer.packages.book', $package) }}" class="w-full bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-300 block text-center mb-4">
                                    Book This Package
                                </a>
                                @else
                                <div class="bg-gray-100 text-gray-500 py-3 px-6 rounded-lg text-center mb-4">
                                    Admin users cannot book packages
                                </div>
                                @endif
                            @else
                            <a href="{{ route('login') }}" class="w-full bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-300 block text-center mb-4">
                                Login to Book
                            </a>
                            @endauth
                        @else
                        <div class="bg-red-100 text-red-600 py-3 px-6 rounded-lg text-center mb-4">
                            Package Currently Unavailable
                        </div>
                        @endif

                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Duration:</span>
                                <span class="font-medium">{{ $package->duration }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Location:</span>
                                <span class="font-medium">{{ $package->location }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Group Size:</span>
                                <span class="font-medium">{{ $package->min_travelers }}-{{ $package->max_travelers }}</span>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="font-semibold text-gray-900 mb-3">Quick Contact</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span>+94 11 123 4567</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>info@thambapanni.com</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Packages -->
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Similar Packages</h3>
                        <div class="space-y-4">
                            <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition duration-300">
                                <div class="font-medium text-gray-900">Kandy Cultural Experience</div>
                                <div class="text-sm text-gray-500">2 Days • $150</div>
                            </a>
                            <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition duration-300">
                                <div class="font-medium text-gray-900">Sigiriya Adventure</div>
                                <div class="text-sm text-gray-500">1 Day • $120</div>
                            </a>
                            <a href="#" class="block p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition duration-300">
                                <div class="font-medium text-gray-900">Galle Fort Tour</div>
                                <div class="text-sm text-gray-500">3 Days • $280</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-16 bg-gradient-to-r from-blue-600 to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Book This Package?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Don't miss out on this amazing Sri Lanka experience. Book now and secure your spot!
            </p>
            <div class="space-x-4">
                @if($package->is_active)
                    @auth
                        @if(auth()->user()->isCustomer())
                        <a href="{{ route('customer.packages.book', $package) }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                            Book Now
                        </a>
                        @else
                        <span class="bg-gray-300 text-gray-600 px-8 py-3 rounded-lg font-semibold inline-block cursor-not-allowed">
                            Admin users cannot book
                        </span>
                        @endif
                    @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                        Login to Book
                    </a>
                    @endauth
                @else
                <span class="bg-gray-300 text-gray-600 px-8 py-3 rounded-lg font-semibold inline-block cursor-not-allowed">
                    Package Unavailable
                </span>
                @endif
                <a href="{{ route('packages') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 inline-block">
                    View All Packages
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
