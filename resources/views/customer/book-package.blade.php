<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Package') }}
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
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('customer.packages.show', $package) }}" class="text-gray-700 hover:text-blue-600">
                                    {{ $package->name }}
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-500">Book Package</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Booking Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Book Your Adventure</h2>
                            
                            <form method="POST" action="{{ route('customer.packages.book.store', $package) }}" class="space-y-6">
                                @csrf
                                
                                <!-- Package Summary -->
                                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                    <div class="flex items-center space-x-4">
                                        @if($package->image)
                                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-green-400 rounded flex items-center justify-center">
                                                <span class="text-white font-bold text-lg">{{ substr($package->location, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $package->name }}</h3>
                                            <p class="text-gray-600">{{ $package->location }} • {{ $package->duration }}</p>
                                            <p class="text-blue-600 font-semibold">${{ number_format($package->price, 2) }} per person</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Travel Details -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="travelers_count" class="block text-sm font-medium text-gray-700 mb-2">
                                            Number of Travelers *
                                        </label>
                                        <input type="number" id="travelers_count" name="travelers_count" 
                                            min="{{ $package->min_travelers }}" max="{{ $package->max_travelers }}" 
                                            value="{{ old('travelers_count', $package->min_travelers) }}" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <p class="text-sm text-gray-500 mt-1">
                                            Min: {{ $package->min_travelers }}, Max: {{ $package->max_travelers }}
                                        </p>
                                        @error('travelers_count')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="travel_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Travel Date *
                                        </label>
                                        <input type="date" id="travel_date" name="travel_date" 
                                            value="{{ old('travel_date') }}" required
                                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <p class="text-sm text-gray-500 mt-1">Select a future date</p>
                                        @error('travel_date')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                                        Payment Method *
                                    </label>
                                    <select id="payment_method" name="payment_method" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Select payment method</option>
                                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    </select>
                                    @error('payment_method')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Special Requests -->
                                <div>
                                    <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-2">
                                        Special Requests
                                    </label>
                                    <textarea id="special_requests" name="special_requests" rows="4"
                                        placeholder="Any special requirements, dietary restrictions, accessibility needs, or other requests..."
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('special_requests') }}</textarea>
                                    <p class="text-sm text-gray-500 mt-1">Optional: Let us know about any special requirements</p>
                                    @error('special_requests')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="flex items-start">
                                    <input type="checkbox" id="terms" name="terms" required
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                                    <label for="terms" class="ml-2 text-sm text-gray-700">
                                        I agree to the 
                                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Terms and Conditions</a> 
                                        and 
                                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Cancellation Policy</a>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end space-x-4">
                                    <a href="{{ route('customer.packages.show', $package) }}" 
                                        class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
                                        Cancel
                                    </a>
                                    <button type="submit" 
                                        class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                                        Continue to Payment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Package Details & Pricing -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Package Summary</h3>
                            
                            <div class="space-y-4">
                                <!-- Package Info -->
                                <div class="border-b border-gray-200 pb-4">
                                    <h4 class="font-medium text-gray-900 mb-2">{{ $package->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $package->location }}</p>
                                    <p class="text-sm text-gray-600">{{ $package->duration }}</p>
                                </div>

                                <!-- Pricing Calculator -->
                                <div class="border-b border-gray-200 pb-4">
                                    <h4 class="font-medium text-gray-900 mb-3">Pricing</h4>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span>Price per person:</span>
                                            <span>${{ number_format($package->price, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span>Number of travelers:</span>
                                            <span id="travelers-display">{{ $package->min_travelers }}</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-2">
                                            <div class="flex justify-between font-medium">
                                                <span>Total Amount:</span>
                                                <span id="total-amount" class="text-blue-600">${{ number_format($package->price * $package->min_travelers, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- What's Included -->
                                @if($package->inclusions && count($package->inclusions) > 0)
                                <div class="border-b border-gray-200 pb-4">
                                    <h4 class="font-medium text-gray-900 mb-3">What's Included</h4>
                                    <ul class="text-sm text-gray-600 space-y-1">
                                        @foreach(array_slice($package->inclusions, 0, 5) as $inclusion)
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $inclusion }}
                                        </li>
                                        @endforeach
                                        @if(count($package->inclusions) > 5)
                                        <li class="text-gray-500 text-xs">+{{ count($package->inclusions) - 5 }} more items</li>
                                        @endif
                                    </ul>
                                </div>
                                @endif

                                <!-- Important Notes -->
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-3">Important Notes</h4>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li>• Booking confirmation subject to availability</li>
                                        <li>• Payment required to confirm booking</li>
                                        <li>• Cancellation policy applies</li>
                                        <li>• Contact us for group bookings</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update pricing when travelers count changes
        document.getElementById('travelers_count').addEventListener('change', function() {
            const travelers = parseInt(this.value);
            const pricePerPerson = {{ $package->price }};
            const total = travelers * pricePerPerson;
            
            document.getElementById('travelers-display').textContent = travelers;
            document.getElementById('total-amount').textContent = '$' + total.toFixed(2);
        });
    </script>
</x-app-layout>
