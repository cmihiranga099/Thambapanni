<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Details') }}
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
                                <a href="{{ route('customer.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                                    My Bookings
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-500">Booking #{{ $booking->booking_reference }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Booking Header -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Booking #{{ $booking->booking_reference }}</h1>
                                    <p class="text-gray-600">{{ $booking->package->name }} • {{ $booking->package->location }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-blue-600">${{ number_format($booking->total_amount, 2) }}</div>
                                    <div class="text-sm text-gray-500">Total Amount</div>
                                </div>
                            </div>
                            
                            <!-- Status Badges -->
                            <div class="flex space-x-4 mb-6">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-blue-100 text-blue-800'
                                    ];
                                    
                                    $paymentColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-green-100 text-green-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                        'refunded' => 'bg-gray-100 text-gray-800'
                                    ];
                                @endphp
                                
                                <div>
                                    <span class="text-sm font-medium text-gray-700">Booking Status:</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ml-2 {{ $statusColors[$booking->booking_status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($booking->booking_status) }}
                                    </span>
                                </div>
                                
                                <div>
                                    <span class="text-sm font-medium text-gray-700">Payment Status:</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ml-2 {{ $paymentColors[$booking->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package Details -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Package Details</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Package Information</h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Package Name:</span>
                                            <span class="font-medium">{{ $booking->package->name }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Location:</span>
                                            <span class="font-medium">{{ $booking->package->location }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Duration:</span>
                                            <span class="font-medium">{{ $booking->package->duration }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Price per Person:</span>
                                            <span class="font-medium">${{ number_format($booking->package->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Travel Information</h4>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Travel Date:</span>
                                            <span class="font-medium">{{ $booking->travel_date->format('M j, Y') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Number of Travelers:</span>
                                            <span class="font-medium">{{ $booking->travelers_count }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Total Amount:</span>
                                            <span class="font-medium text-blue-600">${{ number_format($booking->total_amount, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Payment Method:</span>
                                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    @if($booking->special_requests)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Special Requests</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-gray-700">{{ $booking->special_requests }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Package Highlights -->
                    @if($booking->package->highlights && count($booking->package->highlights) > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Package Highlights</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($booking->package->highlights as $highlight)
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

                    <!-- Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Actions</h3>
                            
                            <div class="flex flex-wrap gap-4">
                                @if($booking->payment_status === 'pending')
                                    <a href="{{ route('customer.payment', $booking) }}" 
                                        class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                                        Complete Payment
                                    </a>
                                @endif
                                
                                @if($booking->booking_status === 'confirmed' && $booking->payment_status === 'paid')
                                    <form action="{{ route('customer.bookings.cancel', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                            class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300"
                                            onclick="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.')">
                                            Cancel Booking
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('contact') }}" 
                                    class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                                    Contact Support
                                </a>
                                
                                <a href="{{ route('customer.dashboard') }}" 
                                    class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Booking Summary -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Booking Summary</h3>
                            
                            <div class="space-y-4">
                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">Booking Reference:</span>
                                        <span class="font-medium">{{ $booking->booking_reference }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600">Booking Date:</span>
                                        <span class="font-medium">{{ $booking->created_at->format('M j, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Last Updated:</span>
                                        <span class="font-medium">{{ $booking->updated_at->format('M j, Y') }}</span>
                                    </div>
                                </div>
                                
                                @if($booking->transaction_id)
                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Transaction ID:</span>
                                        <span class="font-medium">{{ $booking->transaction_id }}</span>
                                    </div>
                                </div>
                                @endif
                                
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-3">Important Information</h4>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li>• Keep your booking reference for all communications</li>
                                        <li>• Arrive 15 minutes before departure time</li>
                                        <li>• Bring valid identification</li>
                                        <li>• Check weather conditions before travel</li>
                                        <li>• Contact us 24 hours before for any changes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Need Help?</h3>
                            
                            <div class="space-y-4">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-blue-900 mb-2">Customer Support</h4>
                                    <p class="text-sm text-blue-700 mb-3">Our team is here to help you with any questions or concerns.</p>
                                    <div class="space-y-2 text-sm text-blue-700">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                            </svg>
                                            support@thambapanni.com
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                            </svg>
                                            +94 11 234 5678
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="{{ route('contact') }}" 
                                    class="w-full bg-blue-600 text-white text-center py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 block">
                                    Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
