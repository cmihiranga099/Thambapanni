<x-app-layout>
    <!-- Hero Section -->
    <div class="relative py-16 sm:py-20 lg:py-24 bg-blue-600 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 sm:mb-8">
                Our Travel Services
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                Comprehensive travel solutions designed to make your Sri Lanka adventure unforgettable
            </p>
        </div>
    </div>

    <!-- Services Overview -->
    <div class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                    What We Offer
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    From customized itineraries to complete travel packages, we provide everything you need for the perfect Sri Lanka experience
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 lg:gap-12">
                <!-- Custom Itineraries -->
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-blue-500 w-20 sm:w-24 h-20 sm:h-24 rounded-md flex items-center justify-center mx-auto mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Custom Itineraries</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Personalized travel plans tailored to your interests, budget, and schedule. We design unique experiences just for you.
                    </p>
                    <div class="space-y-2 text-sm text-gray-500">
                        <div>• Personalized planning</div>
                        <div>• Flexible scheduling</div>
                        <div>• Custom experiences</div>
                    </div>
                </div>

                <!-- Guided Tours -->
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-green-500 w-20 sm:w-24 h-20 sm:h-24 rounded-md flex items-center justify-center mx-auto mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Guided Tours</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Expert local guides who know every hidden gem and can share the rich history and culture of Sri Lanka.
                    </p>
                    <div class="space-y-2 text-sm text-gray-500">
                        <div>• Local expert guides</div>
                        <div>• Cultural insights</div>
                        <div>• Hidden gems access</div>
                    </div>
                </div>

                <!-- Transportation -->
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-yellow-500 w-20 sm:w-24 h-20 sm:h-24 rounded-md flex items-center justify-center mx-auto mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Transportation</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Comfortable and reliable transportation throughout your journey, from airport transfers to inter-city travel.
                    </p>
                    <div class="space-y-2 text-sm text-gray-500">
                        <div>• Airport transfers</div>
                        <div>• Comfortable vehicles</div>
                        <div>• Professional drivers</div>
                    </div>
                </div>

                <!-- Accommodation -->
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-purple-500 w-20 sm:w-24 h-20 sm:h-24 rounded-md flex items-center justify-center mx-auto mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Accommodation</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Carefully selected hotels, resorts, and boutique accommodations that match your style and comfort preferences.
                    </p>
                    <div class="space-y-2 text-sm text-gray-500">
                        <div>• Quality hotels</div>
                        <div>• Boutique options</div>
                        <div>• Best locations</div>
                    </div>
                </div>

                <!-- Cultural Experiences -->
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-red-500 w-20 sm:w-24 h-20 sm:h-24 rounded-md flex items-center justify-center mx-auto mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Cultural Experiences</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Immerse yourself in Sri Lankan culture with authentic experiences, traditional ceremonies, and local interactions.
                    </p>
                    <div class="space-y-2 text-sm text-gray-500">
                        <div>• Traditional ceremonies</div>
                        <div>• Local interactions</div>
                        <div>• Cultural workshops</div>
                    </div>
                </div>

                <!-- Adventure Activities -->
                <div class="group text-center transform hover:scale-105 transition-all duration-300">
                    <div class="bg-indigo-500 w-20 sm:w-24 h-20 sm:h-24 rounded-md flex items-center justify-center mx-auto mb-6 group-hover:rotate-6 transition-transform duration-300 shadow-lg">
                        <svg class="w-10 sm:w-12 h-10 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4">Adventure Activities</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Thrilling outdoor adventures including hiking, wildlife safaris, water sports, and more adrenaline-pumping activities.
                    </p>
                    <div class="space-y-2 text-sm text-gray-500">
                        <div>• Wildlife safaris</div>
                        <div>• Hiking trails</div>
                        <div>• Water sports</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Process -->
    <div class="py-16 sm:py-20 lg:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6">
                    How We Work
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Our simple 4-step process ensures your dream vacation becomes a reality
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Consultation</h3>
                    <p class="text-gray-600">We discuss your preferences, budget, and travel style to understand your vision.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Planning</h3>
                    <p class="text-gray-600">Our experts create a customized itinerary that perfectly matches your requirements.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Confirmation</h3>
                    <p class="text-gray-600">We finalize all details and confirm your bookings for a worry-free experience.</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">4</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Support</h3>
                    <p class="text-gray-600">24/7 support throughout your journey ensures everything goes smoothly.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-16 sm:py-20 lg:py-24 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6 sm:mb-8">
                Ready to Start Planning?
            </h2>
            <p class="text-lg sm:text-xl text-blue-100 mb-8 sm:mb-12 max-w-3xl mx-auto">
                Let us help you create the perfect Sri Lanka adventure. Contact us today to begin your journey!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center">
                <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 sm:px-12 py-3 sm:py-4 rounded-md font-bold text-lg hover:bg-gray-100 transition duration-300 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Get Started
                </a>
                <a href="{{ route('packages') }}" class="border-2 border-white text-white px-8 sm:px-12 py-3 sm:py-4 rounded-md font-bold text-lg hover:bg-white hover:text-blue-600 transition duration-300 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    View Packages
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
