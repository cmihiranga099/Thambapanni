<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * BookingController
 * 
 * This controller handles admin booking management operations.
 * It provides admin interface for viewing and managing all bookings.
 * 
 * Features:
 * - Display all bookings
 * - Update booking status
 * - Booking management interface
 */
class BookingController extends Controller
{
    /**
     * Display a listing of all bookings
     * 
     * Shows all bookings in the system with pagination and filtering.
     * 
     * @param Request $request The HTTP request containing filter parameters
     * @return View The bookings listing view
     */
    public function index(Request $request): View
    {
        // Start building the query
        $query = Booking::with(['user', 'package']);
        
        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('package', function ($packageQuery) use ($search) {
                      $packageQuery->where('name', 'like', "%{$search}%")
                                  ->orWhere('location', 'like', "%{$search}%");
                  });
            });
        }
        
        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('booking_status', $request->get('status'));
        }
        
        // Apply payment status filter if provided
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->get('payment_status'));
        }
        
        // Apply date range filter if provided
        if ($request->filled('date_from')) {
            $query->where('travel_date', '>=', $request->get('date_from'));
        }
        
        if ($request->filled('date_to')) {
            $query->where('travel_date', '<=', $request->get('date_to'));
        }
        
        // Get paginated results
        $bookings = $query->latest()->paginate(20);
        
        // Get filter options for the view
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];
        $paymentStatuses = ['pending', 'paid', 'failed', 'refunded'];
        
        // Pass data to the view
        return view('admin.bookings.index', compact(
            'bookings',
            'statuses',
            'paymentStatuses'
        ));
    }

    /**
     * Update the specified booking
     * 
     * Allows admins to update booking status and other details.
     * 
     * @param Request $request The HTTP request containing update data
     * @param Booking $booking The booking to update
     * @return RedirectResponse Redirect back with success message
     */
    public function update(Request $request, Booking $booking): RedirectResponse
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'booking_status' => 'sometimes|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'sometimes|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string|max:500',
        ]);
        
        // Update the booking
        $booking->update($validated);
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Booking updated successfully.');
    }
}

