<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-3 sm:space-y-0">
            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                {{ __('Booking Successful!') }}
            </h2>
            <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center px-3 sm:px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                {{ __('Back to Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 sm:mb-8">
                <div class="p-6 sm:p-8 bg-gradient-to-r from-green-600 to-emerald-600 text-white text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold mb-2 sm:mb-3">Congratulations!</h1>
                    <p class="text-lg sm:text-xl text-green-100">Your booking has been confirmed successfully.</p>
                    <p class="text-sm sm:text-base text-green-200 mt-2">You're all set for your Sri Lanka adventure!</p>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 sm:mb-8">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 sm:mb-6">Booking Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Package:</span>
                                <p class="text-gray-900">{{ $booking->package->name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Destination:</span>
                                <p class="text-gray-900">{{ $booking->package->location }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Duration:</span>
                                <p class="text-gray-900">{{ $booking->package->duration }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Travel Date:</span>
                                <p class="text-gray-900">{{ $booking->travel_date->format('F j, Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Number of Travelers:</span>
                                <p class="text-gray-900">{{ $booking->travelers_count }} person(s)</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Total Amount:</span>
                                <p class="text-2xl font-bold text-green-600">${{ number_format($booking->total_amount, 2) }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Booking Reference:</span>
                                <p class="text-gray-900 font-mono">{{ $booking->booking_reference }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-700">Status:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ ucfirst($booking->booking_status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($booking->special_requests)
                    <div class="mt-4 sm:mt-6 p-3 sm:p-4 bg-blue-50 rounded-lg">
                        <span class="text-sm font-medium text-blue-700">Special Requests:</span>
                        <p class="text-blue-900 mt-1">{{ $booking->special_requests }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 sm:mb-8">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 sm:mb-6">What's Next?</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                        <a href="{{ route('customer.bookings.pdf', $booking) }}" class="flex flex-col items-center p-4 sm:p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors duration-200 text-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Download Confirmation</h4>
                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Get your booking confirmation as PDF</p>
                        </a>

                        <a href="{{ route('customer.bookings.show', $booking) }}" class="flex flex-col items-center p-4 sm:p-6 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors duration-200 text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm sm:text-base">View Details</h4>
                            <p class="text-xs sm:text-sm text-gray-600 mt-1">See complete booking information</p>
                        </a>

                        <a href="{{ route('customer.packages') }}" class="flex flex-col items-center p-4 sm:p-6 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition-colors duration-200 text-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Explore More</h4>
                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Discover additional travel packages</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 sm:mb-6">Important Information</h3>
                    
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm sm:text-base text-gray-700"><strong>Confirmation Email:</strong> You will receive a confirmation email shortly with all the details.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm sm:text-base text-gray-700"><strong>24/7 Support:</strong> Our travel experts are available round the clock to assist you.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm sm:text-base text-gray-700"><strong>Travel Date:</strong> Please arrive at the designated location on {{ $booking->travel_date->format('F j, Y') }}.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
