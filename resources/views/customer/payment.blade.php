<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Complete Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Payment Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-gradient-to-r from-green-600 to-blue-600 text-white">
                    <h1 class="text-2xl font-bold mb-2">Complete Your Booking</h1>
                    <p class="text-green-100">You're almost there! Complete your payment to confirm your Sri Lanka adventure.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Payment Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-6">Payment Information</h2>
                            
                            <form action="{{ route('customer.payment.process', $booking) }}" method="POST" id="payment-form">
                                @csrf
                                
                                <!-- Payment Method Selection -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Payment Method</label>
                                    <div class="space-y-3">
                                        <label class="flex items-center">
                                            <input type="radio" name="payment_method" value="credit_card" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                            <span class="ml-3 text-sm text-gray-700">Credit Card</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="payment_method" value="debit_card" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-3 text-sm text-gray-700">Debit Card</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="payment_method" value="bank_transfer" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="ml-3 text-sm text-gray-700">Bank Transfer</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Credit Card Details -->
                                <div id="credit-card-fields">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label for="card_number" class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                            <input type="text" id="card_number" name="card_number" required 
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="1234 5678 9012 3456" maxlength="16">
                                            @error('card_number')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="cardholder_name" class="block text-sm font-medium text-gray-700 mb-2">Cardholder Name</label>
                                            <input type="text" id="cardholder_name" name="cardholder_name" required 
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="John Doe">
                                            @error('cardholder_name')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                        <div>
                                            <label for="expiry_month" class="block text-sm font-medium text-gray-700 mb-2">Expiry Month</label>
                                            <select id="expiry_month" name="expiry_month" required 
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="">Month</option>
                                                @for($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                                @endfor
                                            </select>
                                            @error('expiry_month')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="expiry_year" class="block text-sm font-medium text-gray-700 mb-2">Expiry Year</label>
                                            <select id="expiry_year" name="expiry_year" required 
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="">Year</option>
                                                @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('expiry_year')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                            <input type="text" id="cvv" name="cvv" required 
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                placeholder="123" maxlength="3">
                                            @error('cvv')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Transfer Fields (Hidden by default) -->
                                <div id="bank-transfer-fields" class="hidden mb-6">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h3 class="font-medium text-gray-900 mb-3">Bank Transfer Details</h3>
                                        <div class="space-y-3 text-sm text-gray-600">
                                            <div>
                                                <span class="font-medium">Bank Name:</span> Sri Lanka National Bank
                                            </div>
                                            <div>
                                                <span class="font-medium">Account Number:</span> 1234567890
                                            </div>
                                            <div>
                                                <span class="font-medium">Account Holder:</span> Thambapanni Travel Ltd
                                            </div>
                                            <div>
                                                <span class="font-medium">Reference:</span> {{ $booking->booking_reference }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="mb-6">
                                    <label class="flex items-start">
                                        <input type="checkbox" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                                        <span class="ml-3 text-sm text-gray-700">
                                            I agree to the <a href="#" class="text-blue-600 hover:text-blue-700">Terms and Conditions</a> and <a href="#" class="text-blue-600 hover:text-blue-700">Privacy Policy</a>
                                        </span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" 
                                    class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Pay ${{ number_format($booking->total_amount, 2) }}
                                </button>
                            </form>

                            <!-- Security Notice -->
                            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm text-blue-800">Your payment information is secure and encrypted</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Summary -->
                <div class="space-y-6">
                    <!-- Package Details -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Package Details</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Package:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->package->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Location:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->package->location }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Duration:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->package->duration }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Travel Date:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->travel_date->format('M j, Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Travelers:</span>
                                    <span class="font-medium text-gray-900">{{ $booking->travelers_count }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Summary</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Package Price:</span>
                                    <span class="font-medium text-gray-900">${{ number_format($booking->package->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Travelers:</span>
                                    <span class="font-medium text-gray-900">× {{ $booking->travelers_count }}</span>
                                </div>
                                <div class="border-t pt-3">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-semibold text-gray-900">Total Amount:</span>
                                        <span class="text-lg font-bold text-blue-600">${{ number_format($booking->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Reference -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-sm text-gray-600">Booking Reference:</span>
                                    <p class="font-mono text-lg font-bold text-gray-900">{{ $booking->booking_reference }}</p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Booking Date:</span>
                                    <p class="font-medium text-gray-900">{{ $booking->created_at->format('M j, Y g:i A') }}</p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Status:</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $booking->status_badge }}">
                                        {{ ucfirst($booking->booking_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Need Help -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-medium text-blue-900 mb-2">Need Help?</h4>
                        <p class="text-sm text-blue-800 mb-3">If you have any questions about your payment, our support team is here to help.</p>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +94 11 123 4567
                            </div>
                            <div class="flex items-center text-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                support@thambapanni.com
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle payment method fields
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const creditCardFields = document.getElementById('credit-card-fields');
                const bankTransferFields = document.getElementById('bank-transfer-fields');
                
                if (this.value === 'bank_transfer') {
                    creditCardFields.classList.add('hidden');
                    bankTransferFields.classList.remove('hidden');
                } else {
                    creditCardFields.classList.remove('hidden');
                    bankTransferFields.classList.add('hidden');
                }
            });
        });

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
