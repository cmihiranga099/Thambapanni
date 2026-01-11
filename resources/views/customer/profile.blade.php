<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-blue-500 px-6 py-8 rounded-xl shadow-2xl relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-15">
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-yellow-300 to-green-300 rounded-full -mr-20 -mt-20 animate-pulse"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-blue-300 to-purple-300 rounded-full -ml-16 -mb-16 animate-pulse"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-gradient-to-br from-green-300 to-teal-300 rounded-full animate-pulse"></div>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6 relative z-10">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-3 rounded-xl shadow-xl border-2 border-white transform hover:scale-105 transition-transform duration-300">
                    <h2 class="font-bold text-xl sm:text-2xl lg:text-3xl text-white drop-shadow-lg">
                        {{ __('My Profile') }}
                    </h2>
                </div>
                <div class="text-white">
                    <p class="text-lg sm:text-xl text-blue-100 font-medium drop-shadow-md">Manage your travel profile and account settings</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gradient-to-br from-emerald-50 to-teal-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">
            
            <!-- Profile Stats Overview -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border border-gray-100 p-3 sm:p-6 text-center hover:shadow-2xl transition-all duration-300">
                    <div class="bg-emerald-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:w-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xl sm:text-3xl font-bold text-emerald-600">{{ $totalBookings }}</div>
                    <div class="text-xs sm:text-sm text-emerald-600">Total Bookings</div>
                </div>
                
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border border-gray-100 p-3 sm:p-6 text-center hover:shadow-2xl transition-all duration-300">
                    <div class="bg-blue-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-xl sm:text-3xl font-bold text-blue-600">{{ $upcomingTrips->count() }}</div>
                    <div class="text-xs sm:text-sm text-blue-600">Upcoming Trips</div>
                </div>
                
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border border-gray-100 p-3 sm:p-6 text-center hover:shadow-2xl transition-all duration-300">
                    <div class="bg-green-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="text-xl sm:text-3xl font-bold text-green-600">{{ $completedTrips }}</div>
                    <div class="text-xs sm:text-sm text-green-600">Completed Trips</div>
                </div>
                
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border border-gray-100 p-3 sm:p-6 text-center hover:shadow-2xl transition-all duration-300">
                    <div class="bg-purple-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="text-lg sm:text-3xl font-bold text-purple-600">${{ number_format($totalSpent, 0) }}</div>
                    <div class="text-xs sm:text-sm text-purple-600">Total Spent</div>
                </div>
            </div>

            <!-- Recent Bookings Section -->
            @if($recentBookings->count() > 0)
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border-2 border-yellow-200 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 via-orange-500 to-red-500 px-4 sm:px-6 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <div class="bg-white p-3 rounded-xl shadow-lg border-2 border-white">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white drop-shadow-lg">Recent Bookings</h3>
                            <p class="text-sm sm:text-base text-yellow-100 font-medium">Your latest travel arrangements and bookings</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-white px-3 py-1 rounded-full border-2 border-white">
                                <span class="text-xs font-semibold text-yellow-600 uppercase tracking-wide">Recent</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-6 bg-gradient-to-br from-yellow-50 to-orange-50">
                    <div class="space-y-4">
                        @foreach($recentBookings as $booking)
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg hover:bg-yellow-50 transition-colors duration-200 border border-yellow-200 shadow-sm">
                            <div class="flex items-center space-x-4">
                                <div class="bg-yellow-100 p-2 rounded-lg border border-yellow-200">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $booking->package->name ?? 'Package' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $booking->travel_date ? $booking->travel_date->format('M d, Y') : 'Date TBD' }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($booking->booking_status === 'confirmed') bg-green-100 text-green-800 border border-green-200
                                        @elseif($booking->booking_status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @else bg-red-100 text-red-800 border border-red-200 @endif">
                                        {{ ucfirst($booking->booking_status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">${{ number_format($booking->total_amount ?? 0, 0) }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->travelers_count ?? 0 }} travelers</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Upcoming Trips Section -->
            @if($upcomingTrips->count() > 0)
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border-2 border-blue-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 px-4 sm:px-6 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <div class="bg-white p-3 rounded-xl shadow-lg border-2 border-white">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white drop-shadow-lg">Upcoming Trips</h3>
                            <p class="text-sm sm:text-base text-blue-100 font-medium">Your confirmed and upcoming travel adventures</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-white px-3 py-1 rounded-full border-2 border-white">
                                <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Upcoming</span>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-6 bg-gradient-to-br from-blue-50 to-indigo-50">
                    <div class="space-y-4">
                        @foreach($upcomingTrips as $trip)
                        <div class="flex items-center justify-between p-4 bg-white rounded-lg hover:bg-blue-50 transition-colors duration-200 border border-blue-100 shadow-sm">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 p-2 rounded-lg border border-blue-200">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $trip->package->name ?? 'Package' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $trip->travel_date ? $trip->travel_date->format('M d, Y') : 'Date TBD' }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        Confirmed
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">${{ number_format($trip->total_amount ?? 0, 0) }}</p>
                                <p class="text-sm text-gray-500">{{ $trip->travelers_count ?? 0 }} travelers</p>
                                @if($trip->payment_status === 'paid')
                                <a href="{{ route('customer.bookings.pdf', $trip) }}" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors duration-200 mt-2 border border-green-700">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download PDF
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Profile Information Section -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border-2 border-green-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 via-emerald-500 to-teal-500 px-4 sm:px-6 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <div class="bg-white p-3 rounded-xl shadow-lg border-2 border-white">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white drop-shadow-lg">Personal Information</h3>
                            <p class="text-sm sm:text-base text-green-100 font-medium">Update your travel profile and contact details</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-white px-3 py-1 rounded-full border-2 border-white">
                                <span class="text-xs font-semibold text-green-600 uppercase tracking-wide">Profile</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-6 bg-gradient-to-br from-green-50 to-emerald-50">
                    @include('customer.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Security Settings Section -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border-2 border-blue-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-500 px-4 sm:px-6 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <div class="bg-white p-3 rounded-xl shadow-lg border-2 border-white">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white drop-shadow-lg">Security Settings</h3>
                            <p class="text-sm sm:text-base text-blue-100 font-medium">Keep your account secure with a strong password</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-white px-3 py-1 rounded-full border-2 border-white">
                                <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Security</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-6 bg-gradient-to-br from-blue-50 to-indigo-50">
                    @include('customer.partials.update-password-form')
                </div>
            </div>

            <!-- Account Deletion Section -->
            <div class="bg-gradient-to-br from-red-100 to-rose-100 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border-2 border-red-300 overflow-hidden">
                <div class="bg-gradient-to-r from-red-700 via-red-600 to-rose-600 px-4 sm:px-6 py-4 sm:py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <div class="bg-white p-3 rounded-xl shadow-lg border-2 border-white">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white drop-shadow-lg">Account Deletion</h3>
                            <p class="text-sm sm:text-base text-red-100 font-medium">Permanently remove your account and all data</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-white px-3 py-1 rounded-full border-2 border-white shadow-lg">
                                <span class="text-xs font-semibold text-red-600 uppercase tracking-wide">Danger</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-6 bg-gradient-to-br from-red-100 to-rose-100">
                    <div class="bg-red-50 border-2 border-red-200 rounded-lg p-4 mb-4">
                        <div class="flex items-start space-x-3">
                            <div class="bg-red-100 p-2 rounded-lg border border-red-200">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-red-800 mb-1">Warning</h4>
                                <p class="text-sm text-red-700">This action cannot be undone. All your data, bookings, and account information will be permanently deleted.</p>
                            </div>
                        </div>
                    </div>
                    @include('customer.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
