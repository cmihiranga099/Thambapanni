<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Package') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Travel Package</h1>
                            <p class="text-gray-600">Update package information and details</p>
                        </div>
                        <a href="{{ route('admin.packages.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-gray-700 transition duration-300">
                            Back to Packages
                        </a>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Package Name *</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $package->name) }}" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., Colombo City Tour">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                                    <input type="text" id="location" name="location" value="{{ old('location', $package->location) }}" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., Colombo, Kandy, Sigiriya">
                                    @error('location')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration *</label>
                                    <input type="text" id="duration" name="duration" value="{{ old('duration', $package->duration) }}" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., 1 Day, 2 Days, 3 Days">
                                    @error('duration')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (USD) *</label>
                                    <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $package->price) }}" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="0.00">
                                    @error('price')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="min_travelers" class="block text-sm font-medium text-gray-700 mb-2">Minimum Travelers *</label>
                                    <input type="number" id="min_travelers" name="min_travelers" min="1" value="{{ old('min_travelers', $package->min_travelers) }}" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="1">
                                    @error('min_travelers')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="max_travelers" class="block text-sm font-medium text-gray-700 mb-2">Maximum Travelers *</label>
                                    <input type="number" id="max_travelers" name="max_travelers" min="1" value="{{ old('min_travelers', $package->max_travelers) }}" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="20">
                                    @error('max_travelers')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Package Image</label>
                                    @if($package->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $package->image) }}" alt="Current package image" class="w-32 h-24 object-cover rounded">
                                        </div>
                                    @endif
                                    <input type="file" id="image" name="image" accept="image/*"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <p class="text-sm text-gray-500 mt-1">Upload JPG, PNG, or GIF (max 2MB). Leave empty to keep current image.</p>
                                    @error('image')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Description</h3>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Package Description *</label>
                                <textarea id="description" name="description" rows="4" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Describe the package experience, what travelers can expect...">{{ old('description', $package->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Travel Dates</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="departure_date" class="block text-sm font-medium text-gray-700 mb-2">Departure Date</label>
                                    <input type="date" id="departure_date" name="departure_date" 
                                        value="{{ old('departure_date', $package->departure_date?->format('Y-m-d')) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('departure_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="return_date" class="block text-sm font-medium text-gray-700 mb-2">Return Date</label>
                                    <input type="date" id="return_date" name="return_date" 
                                        value="{{ old('return_date', $package->return_date?->format('Y-m-d')) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('return_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Arrays -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Package Details</h3>
                            
                            <!-- Highlights -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Highlights</label>
                                <div id="highlights-container" class="space-y-2">
                                    @foreach($package->highlights ?? [] as $highlight)
                                    <div class="flex space-x-2">
                                        <input type="text" name="highlights[]" value="{{ $highlight }}"
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., Temple Visit, Cultural Show">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endforeach
                                    @if(empty($package->highlights))
                                    <div class="flex space-x-2">
                                        <input type="text" name="highlights[]" 
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., Temple Visit, Cultural Show">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <button type="button" onclick="addField('highlights-container', 'highlights[]')" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Add Highlight
                                </button>
                            </div>

                            <!-- Itinerary -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Itinerary</label>
                                <div id="itinerary-container" class="space-y-2">
                                    @foreach($package->itinerary ?? [] as $item)
                                    <div class="flex space-x-2">
                                        <input type="text" name="itinerary[]" value="{{ $item }}"
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., 9:00 AM - Hotel Pickup">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endforeach
                                    @if(empty($package->itinerary))
                                    <div class="flex space-x-2">
                                        <input type="text" name="itinerary[]" 
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., 9:00 AM - Hotel Pickup">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <button type="button" onclick="addField('itinerary-container', 'itinerary[]')" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Add Itinerary Item
                                </button>
                            </div>

                            <!-- Inclusions -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">What's Included</label>
                                <div id="inclusions-container" class="space-y-2">
                                    @foreach($package->inclusions ?? [] as $inclusion)
                                    <div class="flex space-x-2">
                                        <input type="text" name="inclusions[]" value="{{ $inclusion }}"
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., Transport, Guide, Meals">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endforeach
                                    @if(empty($package->inclusions))
                                    <div class="flex space-x-2">
                                        <input type="text" name="inclusions[]" 
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., Transport, Guide, Meals">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <button type="button" onclick="addField('inclusions-container', 'inclusions[]')" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Add Inclusion
                                </button>
                            </div>

                            <!-- Exclusions -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">What's Not Included</label>
                                <div id="exclusions-container" class="space-y-2">
                                    @foreach($package->exclusions ?? [] as $exclusion)
                                    <div class="flex space-x-2">
                                        <input type="text" name="exclusions[]" value="{{ $exclusion }}"
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., Personal Expenses, Tips">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endforeach
                                    @if(empty($package->exclusions))
                                    <div class="flex space-x-2">
                                        <input type="text" name="exclusions[]" 
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="e.g., Personal Expenses, Tips">
                                        <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <button type="button" onclick="addField('exclusions-container', 'exclusions[]')" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Add Exclusion
                                </button>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Package Status</h3>
                            <div class="flex items-center">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ $package->is_active ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 text-sm text-gray-700">Package is active and available for booking</label>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.packages.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-gray-700 transition duration-300">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-blue-700 transition duration-300">
                                Update Package
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addField(containerId, fieldName) {
            const container = document.getElementById(containerId);
            const newField = document.createElement('div');
            newField.className = 'flex space-x-2';
            newField.innerHTML = `
                <input type="text" name="${fieldName}" 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Enter new item...">
                <button type="button" onclick="removeField(this)" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600">
                    Remove
                </button>
            `;
            container.appendChild(newField);
        }

        function removeField(button) {
            button.parentElement.remove();
        }

        // Set minimum return date based on departure date
        document.getElementById('departure_date').addEventListener('change', function(e) {
            const departureDate = e.target.value;
            const returnDateInput = document.getElementById('return_date');
            returnDateInput.min = departureDate;
        });
    </script>
</x-app-layout>
