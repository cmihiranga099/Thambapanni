<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-3 sm:space-y-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                {{ __('My Dashboard') }}
            </h2>
            <a href="{{ route('customer.profile') }}" class="inline-flex items-center px-3 sm:px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-md hover:bg-emerald-700 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                {{ __('My Profile') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 sm:mb-8">
                <div class="p-4 sm:p-6 bg-green-600 text-white">
                    <h1 class="text-xl sm:text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-sm sm:text-base text-green-100">Manage your Sri Lanka travel bookings and discover new adventures.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-blue-100 p-2 sm:p-3 rounded-lg">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Total Bookings</p>
                                <p class="text-lg sm:text-2xl font-semibold text-gray-900">{{ $totalBookings }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-green-100 p-2 sm:p-3 rounded-lg">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Total Spent</p>
                                <p class="text-lg sm:text-2xl font-semibold text-gray-900">${{ number_format($totalSpent, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-yellow-100 p-2 sm:p-3 rounded-lg">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Next Trip</p>
                                <p class="text-sm sm:text-lg font-semibold text-gray-900">
                                    @if($upcomingTrips->count() > 0)
                                        {{ $upcomingTrips->first()->travel_date->format('M j, Y') }}
                                    @else
                                        No upcoming trips
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-purple-100 p-2 sm:p-3 rounded-lg">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Profile Status</p>
                                <p class="text-sm sm:text-lg font-semibold text-gray-900">
                                    @if(Auth::user()->email_verified_at)
                                        <span class="text-green-600">Verified</span>
                                    @else
                                        <span class="text-yellow-600">Unverified</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 sm:mb-8">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('customer.packages') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m0 0l6-6m-6 6h18"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Browse Packages</p>
                                <p class="text-sm text-gray-600">Find your next adventure</p>
                            </div>
                        </a>

                        <a href="{{ route('customer.bookings') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">My Bookings</p>
                                <p class="text-sm text-gray-600">View all bookings</p>
                            </div>
                        </a>

                        <a href="{{ route('customer.profile') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-300">
                            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">My Profile</p>
                                <p class="text-sm text-gray-600">Update information</p>
                            </div>
                        </a>

                        <a href="{{ route('home') }}" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition duration-300">
                            <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Homepage</p>
                                <p class="text-sm text-gray-600">Back to main site</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 space-y-2 sm:space-y-0">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Recent Bookings</h3>
                        @if($bookings->count() > 0)
                        <a href="{{ route('customer.bookings') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                        @endif
                    </div>

                    @if($bookings->count() > 0)
                        <div class="space-y-3 sm:space-y-4">
                            @foreach($bookings as $booking)
                            <div class="border border-gray-200 rounded-lg p-4 sm:p-6 hover:shadow-md transition duration-300">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between space-y-4 lg:space-y-0">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 sm:space-x-4 mb-3">
                                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-400 to-green-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span class="text-white font-bold text-sm sm:text-lg">{{ substr($booking->package->location, 0, 1) }}</span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-base sm:text-lg font-semibold text-gray-900 truncate">{{ $booking->package->name }}</h4>
                                                <p class="text-xs sm:text-sm text-gray-500">{{ $booking->package->location }} • {{ $booking->package->duration }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 text-xs sm:text-sm">
                                            <div>
                                                <span class="font-medium text-gray-700">Travel Date:</span>
                                                <p class="text-gray-600">{{ $booking->travel_date->format('M j, Y') }}</p>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-700">Travelers:</span>
                                                <p class="text-gray-600">{{ $booking->travelers_count }} person(s)</p>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-700">Total Amount:</span>
                                                <p class="text-gray-600">${{ number_format($booking->total_amount, 2) }}</p>
                                            </div>
                                        </div>

                                        @if($booking->special_requests)
                                        <div class="mt-3">
                                            <span class="font-medium text-gray-700 text-xs sm:text-sm">Special Requests:</span>
                                            <p class="text-gray-600 text-xs sm:text-sm">{{ $booking->special_requests }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="lg:ml-6 lg:text-right">
                                        <div class="mb-3">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'confirmed' => 'bg-green-100 text-green-800',
                                                    'cancelled' => 'bg-red-100 text-red-800',
                                                    'completed' => 'bg-blue-100 text-blue-800'
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$booking->booking_status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($booking->booking_status) }}
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            @php
                                                $paymentColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'paid' => 'bg-green-100 text-green-800',
                                                    'failed' => 'bg-red-100 text-red-800',
                                                    'refunded' => 'bg-gray-100 text-gray-800'
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium {{ $paymentColors[$booking->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($booking->payment_status) }}
                                            </span>
                                        </div>
                                        <div class="text-xs sm:text-sm text-gray-500 mb-3">
                                            Ref: {{ $booking->booking_reference }}
                                        </div>
                                        <div class="space-y-2">
                                            <a href="{{ route('customer.bookings.show', $booking) }}" class="block w-full bg-blue-600 text-white text-center py-2 px-4 rounded hover:bg-blue-700 transition duration-300 text-xs sm:text-sm">
                                                View Details
                                            </a>
                                            @if($booking->booking_status === 'confirmed' && $booking->payment_status === 'paid')
                                            <a href="{{ route('customer.bookings.pdf', $booking) }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white text-center py-2 rounded hover:from-green-600 hover:to-green-700 transition-all duration-300 text-xs sm:text-sm font-medium shadow-md hover:shadow-lg transform hover:scale-105">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Download PDF
                                            </a>
                                            <form action="{{ route('customer.bookings.cancel', $booking) }}" method="POST" class="block">
                                                @csrf
                                                <button type="submit" class="w-full bg-red-600 text-white text-center py-2 px-4 rounded hover:bg-red-700 transition-all duration-300 text-xs sm:text-sm" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                    Cancel Booking
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4 sm:mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="text-center py-8 sm:py-12">
                            <div class="bg-gray-100 rounded-full w-16 h-16 sm:w-24 sm:h-24 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                                </svg>
                            </div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">No bookings yet</h3>
                            <p class="text-sm sm:text-base text-gray-500 mb-4 sm:mb-6">Start your Sri Lanka adventure by booking your first package!</p>
                            <a href="{{ route('customer.packages') }}" class="bg-blue-600 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 inline-block text-sm sm:text-base">
                                Browse Packages
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Travel Tips -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6 sm:mt-8">
                <div class="p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 sm:mb-4">Travel Tips for Sri Lanka</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        <div class="bg-blue-50 p-3 sm:p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-medium text-gray-900 text-sm sm:text-base">Best Time to Visit</h4>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-600">The best time to visit Sri Lanka is from December to April for the west and south coasts, and May to September for the east coast.</p>
                        </div>

                        <div class="bg-green-50 p-3 sm:p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-medium text-gray-900 text-sm sm:text-base">What to Pack</h4>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-600">Pack light, breathable clothing, comfortable walking shoes, sunscreen, insect repellent, and a hat for sun protection.</p>
                        </div>

                        <div class="bg-yellow-50 p-3 sm:p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-medium text-gray-900 text-sm sm:text-base">Local Customs</h4>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-600">Dress modestly when visiting temples, remove shoes before entering religious sites, and always ask permission before taking photos of locals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
