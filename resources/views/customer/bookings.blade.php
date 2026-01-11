<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('customer.bookings') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" 
                                       name="search" 
                                       id="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Package name, location..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" 
                                        id="status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Statuses</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Payment Status Filter -->
                            <div>
                                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment</label>
                                <select name="payment_status" 
                                        id="payment_status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Payment Statuses</option>
                                    @foreach($paymentStatuses as $paymentStatus)
                                        <option value="{{ $paymentStatus }}" {{ request('payment_status') == $paymentStatus ? 'selected' : '' }}>
                                            {{ ucfirst($paymentStatus) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Range -->
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                                <input type="date" 
                                       name="date_from" 
                                       id="date_from" 
                                       value="{{ request('date_from') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                                Apply Filters
                            </button>
                            <a href="{{ route('customer.bookings') }}" 
                               class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 text-center">
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bookings List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($bookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($bookings as $booking)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-300">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <!-- Package Info -->
                                        <div class="flex-1">
                                            <div class="flex items-start gap-4">
                                                @if($booking->package->image)
                                                    <div class="w-20 h-20 bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('storage/' . $booking->package->image) }}')"></div>
                                                @else
                                                    <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-green-400 rounded-lg flex items-center justify-center">
                                                        <span class="text-white text-sm font-bold">{{ $booking->package->location }}</span>
                                                    </div>
                                                @endif
                                                
                                                <div class="flex-1">
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $booking->package->name }}</h3>
                                                    <p class="text-gray-600 text-sm mb-2">{{ $booking->package->location }} • {{ $booking->package->duration }}</p>
                                                    
                                                    <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                                        <span><strong>Reference:</strong> {{ $booking->booking_reference }}</span>
                                                        <span><strong>Travel Date:</strong> {{ \Carbon\Carbon::parse($booking->travel_date)->format('M j, Y') }}</span>
                                                        <span><strong>Travelers:</strong> {{ $booking->travelers_count }}</span>
                                                        <span><strong>Total:</strong> ${{ number_format($booking->total_amount, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status and Actions -->
                                        <div class="flex flex-col items-end gap-3">
                                            <!-- Status Badges -->
                                            <div class="flex flex-col items-end gap-2">
                                                <span class="px-3 py-1 text-xs rounded-full font-medium
                                                    {{ $booking->booking_status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                                       ($booking->booking_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                       ($booking->booking_status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                    {{ ucfirst($booking->booking_status) }}
                                                </span>
                                                
                                                <span class="px-3 py-1 text-xs rounded-full font-medium
                                                    {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                                       ($booking->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                       ($booking->payment_status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                    {{ ucfirst($booking->payment_status) }}
                                                </span>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="flex flex-col gap-2">
                                                <a href="{{ route('customer.bookings.show', $booking) }}" 
                                                   class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700 transition duration-300 text-center">
                                                    View Details
                                                </a>
                                                
                                                @if($booking->payment_status === 'paid' && $booking->booking_status === 'confirmed')
                                                    <a href="{{ route('customer.bookings.pdf', $booking) }}" 
                                                       class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 transition duration-300 text-center">
                                                        Download PDF
                                                    </a>
                                                @endif
                                                
                                                @if($booking->booking_status === 'pending' && $booking->payment_status === 'pending')
                                                    <a href="{{ route('customer.packages.book.payment', $booking) }}" 
                                                       class="bg-yellow-600 text-white px-3 py-1 rounded text-xs hover:bg-yellow-700 transition duration-300 text-center">
                                                        Complete Payment
                                                    </a>
                                                @endif
                                                
                                                @if($booking->booking_status === 'pending')
                                                    <form method="POST" action="{{ route('customer.bookings.cancel', $booking) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" 
                                                                onclick="return confirm('Are you sure you want to cancel this booking?')"
                                                                class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 transition duration-300 w-full">
                                                            Cancel
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
                        <div class="mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <!-- No Bookings -->
                        <div class="text-center py-12">
                            <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Bookings Found</h3>
                            <p class="text-gray-600 mb-4">You haven't made any bookings yet, or no bookings match your current filters.</p>
                            <a href="{{ route('customer.packages') }}" 
                               class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                                Browse Packages
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

