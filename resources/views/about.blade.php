<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <!-- Hero Section -->
    <div class="relative bg-green-600 text-white">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    About Thambapanni Travel
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    Your trusted partner in discovering the authentic beauty and culture of Sri Lanka
                </p>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <p class="text-lg text-gray-600 mb-4">
                        Founded in 2010, Thambapanni Travel was born from a deep passion for showcasing the incredible beauty and rich cultural heritage of Sri Lanka to the world. Our name "Thambapanni" refers to the ancient name of Sri Lanka, meaning "copper-colored land" - a testament to our commitment to preserving and sharing the authentic essence of our homeland.
                    </p>
                    <p class="text-lg text-gray-600 mb-4">
                        What started as a small family business has grown into one of Sri Lanka's most trusted travel companies, serving thousands of satisfied travelers from around the globe. Our journey has been driven by a simple mission: to provide authentic, immersive, and unforgettable Sri Lankan experiences.
                    </p>
                    <p class="text-lg text-gray-600">
                        Today, we continue to expand our offerings while maintaining the personal touch and local expertise that sets us apart. Every package we create, every tour we design, and every interaction we have is infused with our love for Sri Lanka and our dedication to exceptional service.
                    </p>
                </div>
                <div class="bg-yellow-500 rounded-md p-8 text-white">
                    <div class="text-center">
                        <div class="text-6xl font-bold mb-4">13+</div>
                        <div class="text-xl">Years of Excellence</div>
                        <div class="text-sm opacity-90 mt-2">Serving travelers since 2010</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Mission & Vision -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                    <p class="text-gray-600">
                        To provide authentic, sustainable, and transformative travel experiences that showcase the true beauty of Sri Lanka while supporting local communities and preserving our cultural heritage for future generations.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                    <p class="text-gray-600">
                        To be the leading travel company in Sri Lanka, recognized for our commitment to sustainable tourism, cultural preservation, and providing life-changing experiences that connect travelers with the heart and soul of our beautiful island nation.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Values -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Core Values</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    These principles guide everything we do and shape the experiences we create for our travelers
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-yellow-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Authenticity</h3>
                    <p class="text-gray-600">We believe in showing the real Sri Lanka, not just tourist attractions, but the genuine culture, people, and experiences.</p>
                </div>

                <div class="text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Quality</h3>
                    <p class="text-gray-600">We maintain the highest standards in all our services, from accommodations to transportation and local experiences.</p>
                </div>

                <div class="text-center">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sustainability</h3>
                    <p class="text-gray-600">We're committed to responsible tourism that benefits local communities and preserves our natural environment.</p>
                </div>

                <div class="text-center">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Community</h3>
                    <p class="text-gray-600">We work closely with local communities to create meaningful experiences that benefit both travelers and locals.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Team -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Meet Our Team</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our passionate team of travel experts, local guides, and customer service professionals are here to make your Sri Lanka journey extraordinary
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">TD</span>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Thambapanni Dias</h3>
                        <p class="text-blue-600 font-medium mb-2">Founder & CEO</p>
                        <p class="text-gray-600">A passionate Sri Lankan with over 20 years of experience in tourism and hospitality.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">SP</span>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Samantha Perera</h3>
                        <p class="text-blue-600 font-medium mb-2">Head of Operations</p>
                        <p class="text-gray-600">Ensures every tour runs smoothly and exceeds our guests' expectations.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-gradient-to-br from-yellow-400 to-red-500 flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">RK</span>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Rajith Kumar</h3>
                        <p class="text-blue-600 font-medium mb-2">Lead Tour Guide</p>
                        <p class="text-gray-600">A certified guide with deep knowledge of Sri Lanka's history, culture, and hidden gems.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Travelers Choose Us</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Discover what makes Thambapanni Travel the preferred choice for exploring Sri Lanka
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-start space-x-4">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Local Expertise</h3>
                        <p class="text-gray-600">Our team lives and breathes Sri Lanka, providing insider knowledge and authentic experiences.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Personalized Service</h3>
                        <p class="text-gray-600">Every tour is customized to your preferences, ensuring a truly personal experience.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-yellow-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">24/7 Support</h3>
                        <p class="text-gray-600">We're here for you throughout your journey, providing round-the-clock assistance.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Sustainable Tourism</h3>
                        <p class="text-gray-600">We're committed to responsible travel that benefits local communities and preserves our environment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-16 bg-gradient-to-r from-blue-600 to-green-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Experience Sri Lanka with Us?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Join our family of satisfied travelers and discover why Sri Lanka is called the "Pearl of the Indian Ocean"
            </p>
            <div class="space-x-4">
                <a href="{{ route('packages') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">
                    Explore Our Packages
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 inline-block">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
