<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Package') }} - {{ $package->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Package Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Package Image -->
                        <div class="relative">
                            @if($package->image)
                                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $package->image) }}" 
                                         alt="{{ $package->name }}" 
                                         class="w-full h-64 object-cover rounded-lg shadow-md">
                                </div>
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-green-400 rounded-lg flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-lg font-semibold">Package Image</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Package Details -->
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $package->name }}</h1>
                                <p class="text-lg text-gray-600 mb-4">{{ $package->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">${{ number_format($package->price, 2) }}</div>
                                    <div class="text-sm text-gray-600">Per Person</div>
                                </div>
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">{{ $package->duration }}</div>
                                    <div class="text-sm text-gray-600">Duration</div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $package->location }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    <span class="text-gray-700">Max {{ $package->max_travelers }} travelers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Book Your Trip</h3>
                    
                    <form method="POST" action="{{ route('customer.packages.book.store', $package) }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Travel Date -->
                            <div>
                                <label for="travel_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Travel Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       name="travel_date" 
                                       id="travel_date" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('travel_date') border-red-500 @enderror"
                                       value="{{ old('travel_date') }}"
                                       required>
                                @error('travel_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Number of Travelers -->
                            <div>
                                <label for="travelers_count" class="block text-sm font-medium text-gray-700 mb-2">
                                    Number of Travelers <span class="text-red-500">*</span>
                                </label>
                                <select name="travelers_count" 
                                        id="travelers_count" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('travelers_count') border-red-500 @enderror"
                                        required>
                                    <option value="">Select travelers</option>
                                    @for($i = 1; $i <= min($package->max_travelers, 20); $i++)
                                        <option value="{{ $i }}" {{ old('travelers_count') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i == 1 ? 'person' : 'people' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('travelers_count')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div>
                            <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-2">
                                Special Requests (Optional)
                            </label>
                            <textarea name="special_requests" 
                                      id="special_requests" 
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('special_requests') border-red-500 @enderror"
                                      placeholder="Any special requirements, dietary restrictions, or preferences..."
                                      maxlength="500">{{ old('special_requests') }}</textarea>
                            @error('special_requests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Maximum 500 characters</p>
                        </div>

                        <!-- Price Calculation -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-3">Price Breakdown</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Base Price (per person):</span>
                                    <span class="font-medium">${{ number_format($package->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Number of Travelers:</span>
                                    <span class="font-medium" id="display_travelers">1</span>
                                </div>
                                <div class="border-t border-gray-200 pt-2">
                                    <div class="flex justify-between text-lg font-semibold">
                                        <span class="text-gray-900">Total Amount:</span>
                                        <span class="text-blue-600" id="total_amount">${{ number_format($package->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   id="terms_accepted" 
                                   name="terms_accepted" 
                                   class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   required>
                            <label for="terms_accepted" class="ml-2 text-sm text-gray-700">
                                I agree to the <a href="#" class="text-blue-600 hover:text-blue-800 underline">Terms and Conditions</a> and 
                                <a href="#" class="text-blue-600 hover:text-blue-800 underline">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button type="submit" 
                                    class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                                Book Now
                            </button>
                            <a href="{{ route('customer.packages') }}" 
                               class="flex-1 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 text-center">
                                Back to Packages
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dynamic price calculation
        const travelersSelect = document.getElementById('travelers_count');
        const displayTravelers = document.getElementById('display_travelers');
        const totalAmount = document.getElementById('total_amount');
        const basePrice = {{ $package->price }};

        function updatePrice() {
            const travelers = parseInt(travelersSelect.value) || 1;
            const total = basePrice * travelers;
            
            displayTravelers.textContent = travelers;
            totalAmount.textContent = '$' + total.toFixed(2);
        }

        travelersSelect.addEventListener('change', updatePrice);

        // Set minimum date to tomorrow
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        const travelDateInput = document.getElementById('travel_date');
        travelDateInput.min = tomorrow.toISOString().split('T')[0];
    </script>
</x-app-layout>
