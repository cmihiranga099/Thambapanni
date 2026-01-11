<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Display a listing of packages.
     */
    public function index(): View
    {
        // Check if this is an admin request
        $isAdmin = request()->route()->getName() === 'admin.packages.index';

        if ($isAdmin) {
            // Admin view - show all packages with search and filtering
            $query = Package::withCount('bookings');

            // Search functionality
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%");
                });
            }

            // Filter by location
            if (request('location')) {
                $query->where('location', 'like', '%' . request('location') . '%');
            }

            // Filter by status
            if (request('status') !== null && request('status') !== '') {
                $query->where('is_active', (bool)request('status'));
            }

            // Filter by duration
            if (request('duration')) {
                $query->where('duration', request('duration'));
            }

            // Filter by price range
            if (request('min_price')) {
                $query->where('price', '>=', request('min_price'));
            }
            if (request('max_price')) {
                $query->where('price', '<=', request('max_price'));
            }

            $packages = $query->latest()->paginate(10);
            $packages->appends(request()->query());

            // Get available locations for filter dropdown
            $locations = Package::distinct()->pluck('location')->filter()->sort();

            return view('admin.packages.index', compact('packages', 'locations'));
        } else {
            // Public view - show only active packages
            $query = Package::active();

            // Search by name, description, or location
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%");
                });
            }

            // Filter by location
            if (request('location')) {
                $query->where('location', 'like', '%' . request('location') . '%');
            }

            // Filter by price range
            if (request('min_price')) {
                $query->where('price', '>=', request('min_price'));
            }
            if (request('max_price')) {
                $query->where('price', '<=', request('max_price'));
            }

            $packages = $query->latest()->paginate(12);

            // Get available locations for filter dropdown
            $locations = Package::active()->distinct()->pluck('location')->filter()->sort();

            return view('packages.index', compact('packages', 'locations'));
        }
    }

    /**
     * Show the form for creating a new package.
     */
    public function create(): View
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created package in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'highlights' => 'nullable|array',
            'itinerary' => 'nullable|array',
            'exclusions' => 'nullable|array',
            'inclusions' => 'nullable|array',
            'max_travelers' => 'required|integer|min:1',
            'min_travelers' => 'required|integer|min:1',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date|after:departure_date',
            'is_active' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
            $validated['image'] = $imagePath;
        }

        // Filter out empty array values
        $validated['highlights'] = array_filter($validated['highlights'] ?? []);
        $validated['itinerary'] = array_filter($validated['itinerary'] ?? []);
        $validated['inclusions'] = array_filter($validated['inclusions'] ?? []);
        $validated['exclusions'] = array_filter($validated['exclusions'] ?? []);

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully!');
    }

    /**
     * Display the specified package.
     */
    public function show(Package $package): View
    {
        return view('packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit(Package $package): View
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified package in storage.
     */
    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'highlights' => 'nullable|array',
            'itinerary' => 'nullable|array',
            'inclusions' => 'nullable|array',
            'exclusions' => 'nullable|array',
            'max_travelers' => 'required|integer|min:1',
            'min_travelers' => 'required|integer|min:1',
            'departure_date' => 'nullable|date',
            'return_date' => 'nullable|date|after:departure_date',
            'is_active' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($package->image && Storage::disk('public')->exists($package->image)) {
                Storage::disk('public')->delete($package->image);
            }
            $imagePath = $request->file('image')->store('packages', 'public');
            $validated['image'] = $imagePath;
        }

        // Filter out empty array values
        $validated['highlights'] = array_filter($validated['highlights'] ?? []);
        $validated['inclusions'] = array_filter($validated['inclusions'] ?? []);
        $validated['itinerary'] = array_filter($validated['itinerary'] ?? []);
        $validated['exclusions'] = array_filter($validated['exclusions'] ?? []);

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified package from storage.
     */
    public function destroy(Package $package): RedirectResponse
    {
        // Delete associated image if exists
        if ($package->image && Storage::disk('public')->exists($package->image)) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully!');
    }
}


