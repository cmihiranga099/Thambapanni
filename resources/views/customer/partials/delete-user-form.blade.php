<section class="space-y-6">
    <form method="post" action="{{ route('customer.profile.destroy') }}" class="space-y-6">
        @csrf
        @method('delete')

        <!-- Warning Message -->
        <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-lg font-medium text-red-800">Delete Travel Account</h4>
                    <p class="text-sm text-red-700 mt-1">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. This includes all your travel bookings, payment history, and personal preferences. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Travel Data Warning -->
        <div class="p-4 bg-orange-50 border border-orange-200 rounded-xl">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-orange-800">Important Travel Data Notice</h5>
                    <p class="text-sm text-orange-700 mt-1">
                        Deleting your account will permanently remove all your travel bookings, payment records, and travel preferences. This action cannot be undone and may affect any ongoing travel arrangements.
                    </p>
                </div>
            </div>
        </div>

        <!-- Password Confirmation -->
        <div class="space-y-2">
            <label for="password" class="flex items-center space-x-2 text-sm font-semibold text-gray-700">
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span>{{ __('Confirm Password') }}</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="password" name="password" type="password" 
                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 bg-gray-50 hover:bg-white" 
                    placeholder="Enter your password to confirm deletion">
            </div>
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6">
                    <div class="flex items-center gap-4">
                        <x-danger-button class="bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 border-0 shadow-lg hover:shadow-xl transition-all duration-300 px-6 py-3 text-white font-semibold rounded-lg">
                            {{ __('Delete Account') }}
                        </x-danger-button>

                        @if (session('status') === 'user-deleted')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-red-600 bg-red-100 px-4 py-2 rounded-lg border border-red-200"
                            >{{ __('Account deleted successfully.') }}</p>
                        @endif
                    </div>
        </div>
    </form>

    <!-- Alternative Options -->
    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h5 class="text-sm font-medium text-gray-800">Consider Alternatives</h5>
                <p class="text-sm text-gray-700 mt-1">
                    Instead of deleting your account, you might want to consider deactivating it temporarily or contacting our support team if you're experiencing issues with your travel bookings.
                </p>
                <div class="mt-3 flex space-x-3">
                    <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
