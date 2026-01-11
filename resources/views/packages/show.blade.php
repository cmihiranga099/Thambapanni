<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-3 sm:space-y-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                {{ $package->name }}
            </h2>
            <a href="{{ route('packages') }}" class="inline-flex items-center px-3 sm:px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Packages
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12">
                <!-- Package Image -->
                <div class="space-y-4">
                    @if($package->image)
                        <div class="h-64 sm:h-80 bg-cover bg-center rounded-lg shadow-lg" style="background-image: url('{{ asset('storage/' . $package->image) }}')">
                            <div class="h-full w-full bg-black bg-opacity-20 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-2xl sm:text-3xl">{{ $package->location }}</span>
                            </div>
                        </div>
                    @else
                        <div class="h-64 sm:h-80 bg-gradient-to-br from-blue-400 to-green-400 rounded-lg shadow-lg flex items-center justify-center">
                            <span class="text-white font-bold text-2xl sm:text-3xl">{{ $package->location }}</span>
                        </div>
                    @endif
                </div>

                <!-- Package Details -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $package->name }}</h1>
                        <p class="text-lg text-gray-600">{{ $package->location }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 sm:p-6">
                        <div class="grid grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Duration</span>
                                <p class="text-lg font-semibold text-gray-900">{{ $package->duration }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Price</span>
                                <p class="text-2xl font-bold text-blue-600">${{ number_format($package->price, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $package->description }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        @auth
                            <a href="{{ route('customer.packages.book', $package) }}" 
                               class="w-full bg-green-600 text-white text-center py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-300 text-lg">
                                Book This Package
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="w-full bg-green-600 text-white text-center py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-300 text-lg">
                                Login to Book
                            </a>
                        @endauth
                        
                        <a href="{{ route('contact') }}" 
                           class="w-full bg-blue-600 text-white text-center py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 text-lg">
                            Contact Us for More Info
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Packages -->
            @if($relatedPackages->count() > 0)
                <div class="mt-16 sm:mt-20">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Related Packages</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        @foreach($relatedPackages as $relatedPackage)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300">
                                @if($relatedPackage->image)
                                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $relatedPackage->image) }}')">
                                        <div class="h-full w-full bg-black bg-opacity-30 flex items-center justify-center">
                                            <span class="text-white font-bold text-lg">{{ $relatedPackage->location }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="h-40 bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">{{ $relatedPackage->location }}</span>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $relatedPackage->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($relatedPackage->description, 80) }}</p>
                                    
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm text-gray-500">{{ $relatedPackage->duration }}</span>
                                        <span class="text-lg font-bold text-blue-600">${{ number_format($relatedPackage->price, 2) }}</span>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <a href="{{ route('packages.show', $relatedPackage) }}" 
                                           class="flex-1 bg-blue-600 text-white text-center py-2 px-3 rounded text-sm hover:bg-blue-700 transition duration-300">
                                            View Details
                                        </a>
                                        @auth
                                            <a href="{{ route('customer.packages.book', $relatedPackage) }}" 
                                               class="flex-1 bg-green-600 text-white text-center py-2 px-3 rounded text-sm hover:bg-green-700 transition duration-300">
                                                Book Now
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" 
                                               class="flex-1 bg-green-600 text-white text-center py-2 px-3 rounded text-sm hover:bg-green-700 transition duration-300">
                                                Login
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

