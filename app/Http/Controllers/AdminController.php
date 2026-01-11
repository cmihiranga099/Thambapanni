<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $totalPackages = Package::count();
        $totalBookings = Booking::count();
        $totalCustomers = User::role('customer')->count();
        $totalContacts = Contact::count();
        
        // Enhanced statistics
        $totalRevenue = Booking::where('payment_status', 'paid')->sum('total_amount');
        $thisMonthRevenue = Booking::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');
        
        $pendingBookings = Booking::where('booking_status', 'pending')->count();
        $confirmedBookings = Booking::where('booking_status', 'confirmed')->count();
        $recentBookings = Booking::with(['user', 'package'])->latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();
        
        // Top performing packages
        $topPackages = Package::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(3)
            ->get();
        
        // Monthly growth
        $lastMonthBookings = Booking::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $growthRate = $lastMonthBookings > 0 ? 
            (($totalBookings - $lastMonthBookings) / $lastMonthBookings) * 100 : 0;

        return view('admin.dashboard', compact(
            'totalPackages',
            'totalBookings',
            'totalCustomers',
            'totalContacts',
            'totalRevenue',
            'thisMonthRevenue',
            'pendingBookings',
            'confirmedBookings',
            'recentBookings',
            'recentContacts',
            'topPackages',
            'growthRate'
        ));
    }

    public function packages(): View
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function packagesCreate(): View
    {
        return view('admin.packages.create');
    }

    public function packagesStore(Request $request): RedirectResponse
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

    public function packagesEdit(Package $package): View
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function packagesUpdate(Request $request, Package $package): RedirectResponse
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

    public function packagesDestroy(Package $package): RedirectResponse
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully!');
    }

    public function bookings(): View
    {
        $bookings = Booking::with(['user', 'package'])->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function bookingsUpdate(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'booking_status' => 'required|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function contacts(): View
    {
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function contactsUpdate(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied'
        ]);

        $contact->update($validated);

        return redirect()->route('admin.contacts.index')->with('success', 'Contact status updated successfully!');
    }

    public function customers(): View
    {
        $customers = User::role('customer')->withCount('bookings')->latest()->paginate(15);
        return view('admin.customers.index', compact('customers'));
    }

    public function reports(): View
    {
        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        $packageBookings = Package::withCount('bookings')->orderBy('bookings_count', 'desc')->take(10)->get();

        $revenue = Booking::where('payment_status', 'paid')->sum('total_amount');

        return view('admin.reports', compact('monthlyBookings', 'packageBookings', 'revenue'));
    }
}
