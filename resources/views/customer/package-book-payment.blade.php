<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Complete Payment') }} - {{ $currentBooking->package->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Booking Summary -->
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Booking Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-2">Package Details</h4>
                                <div class="space-y-2 text-sm">
                                    <div><span class="font-medium">Package:</span> {{ $currentBooking->package->name }}</div>
                                    <div><span class="font-medium">Location:</span> {{ $currentBooking->package->location }}</div>
                                    <div><span class="font-medium">Duration:</span> {{ $currentBooking->package->duration }}</div>
                                    <div><span class="font-medium">Travel Date:</span> {{ \Carbon\Carbon::parse($currentBooking->travel_date)->format('F j, Y') }}</div>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-2">Booking Details</h4>
                                <div class="space-y-2 text-sm">
                                    <div><span class="font-medium">Reference:</span> {{ $currentBooking->booking_reference }}</div>
                                    <div><span class="font-medium">Travelers:</span> {{ $currentBooking->travelers_count }} person(s)</div>
                                    <div><span class="font-medium">Status:</span> 
                                        <span class="px-2 py-1 text-xs rounded-full {{ $currentBooking->booking_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($currentBooking->booking_status) }}
                                        </span>
                                    </div>
                                    <div><span class="font-medium">Total Amount:</span> <span class="font-bold text-blue-600">${{ number_format($currentBooking->total_amount, 2) }}</span></div>
                                </div>
                            </div>
                        </div>
                        
                        @if($currentBooking->special_requests)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h4 class="font-semibold text-gray-700 mb-2">Special Requests</h4>
                                <p class="text-sm text-gray-600">{{ $currentBooking->special_requests }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Payment Form -->
                    <form method="POST" action="{{ route('customer.packages.book.payment.process', ['package' => $currentBooking->package->id, 'booking' => $currentBooking->id]) }}" class="space-y-6">
                        @csrf
                        
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Card Number -->
                                <div class="md:col-span-2">
                                    <label for="card_number" class="block text-sm font-medium text-gray-700 mb-2">
                                        Card Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           name="card_number"
                                           id="card_number"
                                           maxlength="19"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('card_number') border-red-500 @enderror"
                                           placeholder="1234 5678 9012 3456"
                                           value="{{ old('card_number') }}"
                                           required>
                                    @error('card_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">
                                        <strong>Test Card Numbers:</strong> 4111 1111 1111 1111, 4000 0000 0000 0002, or 5555 5555 5555 4444
                                    </p>
                                </div>

                                <!-- Expiry Month -->
                                <div>
                                    <label for="expiry_month" class="block text-sm font-medium text-gray-700 mb-2">
                                        Expiry Month <span class="text-red-500">*</span>
                                    </label>
                                    <select name="expiry_month" 
                                            id="expiry_month" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('expiry_month') border-red-500 @enderror"
                                            required>
                                        <option value="">Month</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ old('expiry_month') == $i ? 'selected' : '' }}>
                                                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('expiry_month')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Expiry Year -->
                                <div>
                                    <label for="expiry_year" class="block text-sm font-medium text-gray-700 mb-2">
                                        Expiry Year <span class="text-red-500">*</span>
                                    </label>
                                    <select name="expiry_year" 
                                            id="expiry_year" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('expiry_year') border-red-500 @enderror"
                                            required>
                                        <option value="">Year</option>
                                        @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}" {{ old('expiry_year') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('expiry_year')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CVV -->
                                <div>
                                    <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">
                                        CVV <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           name="cvv"
                                           id="cvv"
                                           maxlength="4"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('cvv') border-red-500 @enderror"
                                           placeholder="123"
                                           value="{{ old('cvv') }}"
                                           required>
                                    @error('cvv')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Use any 3 digits (e.g., 123)</p>
                                </div>

                                <!-- Cardholder Name -->
                                <div>
                                    <label for="cardholder_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Cardholder Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="cardholder_name" 
                                           id="cardholder_name" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('cardholder_name') border-red-500 @enderror"
                                           placeholder="John Doe"
                                           value="{{ old('cardholder_name', auth()->user()->name) }}"
                                           required>
                                    @error('cardholder_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Security Notice -->
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium">Secure Payment</p>
                                    <p>Your payment information is encrypted and secure. This is a demo application - no real payments will be processed.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   id="payment_terms_accepted" 
                                   name="payment_terms_accepted" 
                                   class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   required>
                            <label for="payment_terms_accepted" class="ml-2 text-sm text-gray-700">
                                I authorize the charge of <span class="font-bold">${{ number_format($currentBooking->total_amount, 2) }}</span> to my payment method and agree to the 
                                <a href="#" class="text-blue-600 hover:text-blue-800 underline">Terms and Conditions</a>
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button type="submit" 
                                    class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300">
                                Complete Payment
                            </button>
                            <a href="{{ route('customer.dashboard') }}" 
                               class="flex-1 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 text-center">
                                Cancel & Return to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Format card number with spaces
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });

        // Format CVV to numbers only
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
    </script>
</x-app-layout>
