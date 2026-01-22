<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Package Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('customer.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('customer.packages') }}" class="text-gray-700 hover:text-blue-600">
                                    Packages
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-500">{{ $package->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Package Header -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        @if($package->image)
                            <div class="h-64 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $package->image) }}')">
                                <div class="h-full w-full bg-black bg-opacity-30 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <h1 class="text-4xl font-bold mb-2">{{ $package->name }}</h1>
                                        <p class="text-xl">{{ $package->location }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="h-64 bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <h1 class="text-4xl font-bold mb-2">{{ $package->name }}</h1>
                                    <p class="text-xl">{{ $package->location }}</p>
                                </div>
                            </div>
                        @endif

                        @if(!empty($package->gallery_images))
                            <div class="p-6 border-t border-gray-100">
                                <h3 class="text-base font-semibold text-gray-900 mb-3">More Photos</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    @foreach($package->gallery_images as $galleryImage)
                                        @php
                                            $galleryUrl = Str::startsWith($galleryImage, ['http://', 'https://'])
                                                ? $galleryImage
                                                : asset('storage/' . $galleryImage);
                                        @endphp
                                        <div class="h-24 sm:h-28 bg-cover bg-center rounded-md shadow-sm" style="background-image: url('{{ $galleryUrl }}')"></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">{{ $package->name }}</h2>
                                    <p class="text-gray-600">{{ $package->location }} • {{ $package->duration }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-blue-600">${{ number_format($package->price, 2) }}</div>
                                    <div class="text-sm text-gray-500">per person</div>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 text-lg leading-relaxed">{{ $package->description }}</p>
                        </div>
                    </div>

                    <!-- Package Details -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Package Details</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Travel Information</h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Duration:</span>
                                            <span class="font-medium">{{ $package->duration }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Location:</span>
                                            <span class="font-medium">{{ $package->location }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Min Travelers:</span>
                                            <span class="font-medium">{{ $package->min_travelers }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Max Travelers:</span>
                                            <span class="font-medium">{{ $package->max_travelers }}</span>
                                        </div>
                                        @if($package->departure_date)
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Departure Date:</span>
                                            <span class="font-medium">{{ $package->departure_date->format('M j, Y') }}</span>
                                        </div>
                                        @endif
                                        @if($package->return_date)
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Return Date:</span>
                                            <span class="font-medium">{{ $package->return_date->format('M j, Y') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Package Status</h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Status:</span>
                                            @if($package->is_active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Inactive
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Price:</span>
                                            <span class="font-medium text-blue-600">${{ number_format($package->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Highlights -->
                    @if($package->highlights && count($package->highlights) > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Highlights</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($package->highlights as $highlight)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-700">{{ $highlight }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Itinerary -->
                    @if($package->itinerary && count($package->itinerary) > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Itinerary</h3>
                            <div class="space-y-3">
                                @foreach($package->itinerary as $index => $item)
                                <div class="flex items-start">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-medium mr-3 mt-1">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-gray-700">{{ $item }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Inclusions & Exclusions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        @if($package->inclusions && count($package->inclusions) > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 text-green-600">What's Included</h3>
                                <div class="space-y-2">
                                    @foreach($package->inclusions as $inclusion)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700">{{ $inclusion }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($package->exclusions && count($package->exclusions) > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 text-red-600">What's Not Included</h3>
                                <div class="space-y-2">
                                    @foreach($package->exclusions as $exclusion)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-700">{{ $exclusion }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar - Booking Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Book This Package</h3>
                            
                            @if($package->is_active)
                                <div class="space-y-4">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-blue-600 mb-1">${{ number_format($package->price, 2) }}</div>
                                        <div class="text-sm text-gray-500">per person</div>
                                    </div>
                                    
                                    <div class="border-t border-gray-200 pt-4">
                                        <div class="text-sm text-gray-600 mb-2">Package includes:</div>
                                        <ul class="text-sm text-gray-600 space-y-1">
                                            <li>• Professional guide</li>
                                            <li>• Transportation</li>
                                            <li>• Accommodation (multi-day packages)</li>
                                            <li>• Meals as specified</li>
                                            <li>• Entrance fees</li>
                                        </ul>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <a href="{{ route('customer.packages.book', $package) }}" 
                                            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white text-center py-2.5 px-4 rounded-lg font-medium hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-[1.02] shadow-sm block">
                                            Book Now
                                        </a>
                                        <a href="{{ route('contact') }}" 
                                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center py-2.5 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-[1.02] shadow-sm block">
                                            Ask Questions
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Package Unavailable</h4>
                                    <p class="text-gray-500 mb-4">This package is currently not available for booking.</p>
                                    <a href="{{ route('customer.packages') }}" 
                                        class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-[1.02] shadow-sm">
                                        Browse Other Packages
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
