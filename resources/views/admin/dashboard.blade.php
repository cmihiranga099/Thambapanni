<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-blue-600 text-white">
                    <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-blue-100">Here's what's happening with your travel business today.</p>
                </div>
            </div>

            <!-- Enhanced Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Packages</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalPackages }}</p>
                                <p class="text-xs text-gray-500">Active travel packages</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-green-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                                <p class="text-2xl font-semibold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
                                <p class="text-xs text-gray-500">All time earnings</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-yellow-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Bookings</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalBookings }}</p>
                                <p class="text-xs text-gray-500">
                                    <span class="text-green-600">+{{ number_format($growthRate, 1) }}%</span> from last month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-purple-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Customers</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalCustomers }}</p>
                                <p class="text-xs text-gray-500">Registered users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Statistics Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-2xl font-bold text-blue-600">${{ number_format($thisMonthRevenue, 2) }}</div>
                        <p class="text-sm text-gray-500">This Month's Revenue</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $pendingBookings }}</div>
                        <p class="text-sm text-gray-500">Pending Bookings</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $confirmedBookings }}</div>
                        <p class="text-sm text-gray-500">Confirmed Bookings</p>
                    </div>
                </div>
            </div>

            <!-- Top Performing Packages -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Performing Packages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($topPackages as $package)
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($package->image)
                                <div class="h-32 bg-cover bg-center rounded mb-3" style="background-image: url('{{ asset('storage/' . $package->image) }}')">
                                    <div class="h-full w-full bg-black bg-opacity-40 rounded flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">{{ $package->location }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="h-32 bg-gradient-to-br from-blue-400 to-green-400 rounded mb-3 flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">{{ $package->location }}</span>
                                </div>
                            @endif
                            
                            <h4 class="font-semibold text-gray-900 mb-2">{{ $package->name }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($package->description, 80) }}</p>
                            
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-gray-500">{{ $package->duration }}</span>
                                <span class="text-lg font-bold text-blue-600">${{ number_format($package->price, 2) }}</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">{{ $package->bookings_count }} bookings</span>
                                <a href="{{ route('admin.packages.edit', $package) }}"
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit Package</a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-8 text-gray-500">
                            No packages found
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Bookings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Bookings</h3>
                        <div class="space-y-4">
                            @forelse($recentBookings as $booking)
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-sm">{{ substr($booking->user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900">{{ $booking->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $booking->package->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $booking->created_at->format('M j, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($booking->total_amount, 2) }}</p>
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            'completed' => 'bg-blue-100 text-blue-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$booking->booking_status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($booking->booking_status) }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8 text-gray-500">
                                No recent bookings
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Contacts -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Contact Messages</h3>
                        <div class="space-y-4">
                            @forelse($recentContacts as $contact)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <p class="font-medium text-gray-900">{{ $contact->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $contact->email }}</p>
                                    <p class="text-xs text-gray-400">{{ $contact->created_at->format('M j, Y') }}</p>
                                </div>
                                @php
                                    $contactColors = [
                                        'new' => 'bg-blue-100 text-blue-800',
                                        'read' => 'bg-green-100 text-green-800',
                                        'replied' => 'bg-purple-100 text-purple-800',
                                        'closed' => 'bg-gray-100 text-gray-800'
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $contactColors[$contact->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($contact->status) }}
                                </span>
                                <p class="text-sm font-medium text-gray-700 mb-2">{{ $contact->subject }}</p>
                                <p class="text-xs text-gray-600">{{ Str::limit($contact->message, 100) }}</p>
                            </div>
                            @empty
                            <div class="text-center py-8 text-gray-500">
                                No recent contacts
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('admin.packages.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Add Package</p>
                                <p class="text-sm text-gray-600">Create new travel package</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.packages.index') }}" class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition duration-300">
                            <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Manage Packages</p>
                                <p class="text-sm text-gray-600">Edit & manage packages</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.bookings.index') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Manage Bookings</p>
                                <p class="text-sm text-gray-600">View all bookings</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.customers.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-300">
                            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Manage Customers</p>
                                <p class="text-sm text-gray-600">Customer accounts</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.reports') }}" class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition duration-300">
                            <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Reports</p>
                                <p class="text-sm text-gray-600">Analytics & insights</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Growth Chart Placeholder -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Growth</h3>
                    <div class="text-center py-8">
                        <div class="text-3xl font-bold text-gray-900 mb-2">
                            @if($growthRate >= 0)
                                <span class="text-green-600">+{{ number_format($growthRate, 1) }}%</span>
                            @else
                                <span class="text-red-600">{{ number_format($growthRate, 1) }}%</span>
                            @endif
                        </div>
                        <p class="text-gray-600">Booking growth compared to last month</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
