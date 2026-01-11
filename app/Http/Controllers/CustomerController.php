<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Booking;
use App\Services\BookingPdfService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

/**
 * CustomerController
 * 
 * This controller handles all customer-specific operations including:
 * - Dashboard display with booking information
 * - Package browsing and selection
 * - Booking management (view, cancel)
 * - PDF generation and download
 * - Booking success page display
 * - Profile management
 * 
 * Features:
 * - Role-based access control (customer only)
 * - PDF generation for booking confirmations
 * - Booking status management
 * - User profile operations
 * 
 * Middleware:
 * - 'auth' - Ensures user is authenticated
 * - 'role:customer' - Ensures user has customer role
 */
class CustomerController extends Controller
{
    /**
     * The PDF service instance for generating booking confirmations
     * 
     * @var BookingPdfService
     */
    protected $pdfService;

    /**
     * Create a new controller instance
     * 
     * @param BookingPdfService $pdfService Service for PDF generation
     */
    public function __construct(BookingPdfService $pdfService)
    {
        // Inject the PDF service for use in PDF-related methods
        $this->pdfService = $pdfService;
    }

    /**
     * Display the customer dashboard
     * 
     * Shows an overview of the customer's bookings, statistics,
     * and quick access to key features. Includes error handling
     * to prevent undefined variable errors.
     * 
     * @return View The customer dashboard view
     */
    public function dashboard(): View
    {
        // Initialize all variables with default values to prevent undefined variable errors
        $featuredPackages = collect();
        $recentBookings = collect();
        $totalBookings = 0;
        $confirmedBookings = 0;
        $pendingBookings = 0;
        $totalSpent = 0;
        $upcomingTrips = collect();
        $profileComplete = false;
        $bookings = collect();
        
        try {
            // Get the authenticated user
            $user = auth()->user();
            
            // Retrieve user's recent bookings with package information
            $recentBookings = $user->bookings()
                ->with('package')
                ->latest()
                ->take(5)
                ->get();
            
            // Get total number of bookings for statistics
            $totalBookings = $user->bookings()->count();
            
            // Get confirmed/paid bookings count
            $confirmedBookings = $user->bookings()
                ->where('booking_status', 'confirmed')
                ->where('payment_status', 'paid')
                ->count();
            
            // Get pending bookings count
            $pendingBookings = $user->bookings()
                ->where('booking_status', 'pending')
                ->count();
            
            // Calculate total amount spent on confirmed/paid bookings
            $totalSpent = $user->bookings()
                ->where('payment_status', 'paid')
                ->sum('total_amount');
            
            // Get upcoming trips (confirmed bookings with future travel dates)
            $upcomingTrips = $user->bookings()
                ->with('package')
                ->where('booking_status', 'confirmed')
                ->where('payment_status', 'paid')
                ->where('travel_date', '>', now())
                ->orderBy('travel_date', 'asc')
                ->take(3)
                ->get();
            
            // Get upcoming trips count for statistics
            $upcomingTripsCount = $upcomingTrips->count();
            
            // Check if user profile is complete (has name and email)
            $profileComplete = !empty($user->name) && !empty($user->email);
            
            // Get featured packages for new customers (if they have no bookings)
            if ($totalBookings == 0) {
                try {
                    // Check if Package model exists and database is accessible
                    if (class_exists('App\Models\Package')) {
                        $featuredPackages = Package::where('is_active', true)
                            ->latest()
                            ->take(3)
                            ->get();
                    } else {
                        $featuredPackages = collect();
                        \Log::warning('Package model not found for user ' . $user->id);
                    }
                } catch (\Exception $e) {
                    // If there's an error, ensure we have an empty collection
                    $featuredPackages = collect();
                    \Log::warning('Failed to fetch featured packages for user ' . $user->id . ': ' . $e->getMessage());
                }
            }
            
            // Get all bookings for the dashboard (paginated)
            $bookings = $user->bookings()
                ->with('package')
                ->latest()
                ->paginate(10);
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in customer dashboard: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Ensure all variables have safe default values
            $featuredPackages = collect();
            $recentBookings = collect();
            $totalBookings = 0;
            $confirmedBookings = 0;
            $pendingBookings = 0;
            $totalSpent = 0;
            $upcomingTrips = collect();
            $profileComplete = false;
            $bookings = collect();
        }
        
        // Pass data to the dashboard view
        return view('customer.dashboard', compact(
            'user',
            'recentBookings',
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'totalSpent',
            'upcomingTrips',
            'profileComplete',
            'featuredPackages',
            'bookings'
        ));
    }

    /**
     * Display available packages for booking
     * 
     * Shows a list of all available travel packages that customers
     * can browse and select for booking.
     * 
     * @return View The packages listing view
     */
    public function packages(): View
    {
        $query = Package::where('is_active', true);

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

        // Filter by duration
        if (request('duration')) {
            $query->where('duration', request('duration'));
        }

        // Filter by price range
        if (request('price_range')) {
            $priceRange = request('price_range');
            if ($priceRange === '0-100') {
                $query->where('price', '<=', 100);
            } elseif ($priceRange === '100-200') {
                $query->whereBetween('price', [100, 200]);
            } elseif ($priceRange === '200-300') {
                $query->whereBetween('price', [200, 300]);
            } elseif ($priceRange === '300+') {
                $query->where('price', '>', 300);
            }
        }

        // Retrieve packages with pagination, preserving query parameters
        $packages = $query->orderBy('created_at', 'desc')->paginate(12);
        $packages->appends(request()->query());

        // Return the packages view with data
        return view('customer.packages', compact('packages'));
    }

    /**
     * Display all customer bookings with search and filtering
     * 
     * Shows a comprehensive list of all bookings made by the customer
     * with search functionality and pagination.
     * 
     * @param Request $request The HTTP request containing search parameters
     * @return View The bookings listing view
     */
    public function bookings(Request $request): View
    {
        // Get the authenticated user
        $user = auth()->user();
        
        // Start building the query
        $query = $user->bookings()->with('package');
        
        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('package', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
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
        $bookings = $query->latest()->paginate(15);
        
        // Get filter options for the view
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];
        $paymentStatuses = ['pending', 'paid', 'failed', 'refunded'];
        
        // Pass data to the view
        return view('customer.bookings', compact(
            'bookings',
            'statuses',
            'paymentStatuses'
        ));
    }

    /**
     * Display a specific package for detailed viewing
     * 
     * Shows detailed information about a specific travel package
     * including description, pricing, and booking options.
     * 
     * @param Package $package The package to display
     * @return View The package detail view
     */
    public function packageShow(Package $package): View
    {
        // Return the package detail view with the package data
        return view('customer.package-show', compact('package'));
    }

    /**
     * Display the booking form for a specific package
     * 
     * Shows a form where customers can enter their details
     * and preferences to book a travel package.
     * 
     * @param Package $package The package to book
     * @return View The booking form view
     */
    public function packageBook(Package $package): View
    {
        // Return the booking form view with the package data
        return view('customer.package-book', compact('package'));
    }

    /**
     * Process the booking request and create a new booking
     * 
     * Handles the form submission from the booking form, validates
     * the input, creates a new booking record, and redirects to
     * the payment process.
     * 
     * @param Request $request The HTTP request containing booking data
     * @param Package $package The package being booked
     * @return RedirectResponse Redirect to payment or dashboard
     */
    public function packageBookStore(Request $request, Package $package): RedirectResponse
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'travel_date' => 'required|date|after:today',
            'travelers_count' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string|max:500',
        ]);

        // Create a new booking record
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'package_id' => $package->id,
            'travel_date' => $validated['travel_date'],
            'travelers_count' => $validated['travelers_count'],
            'special_requests' => $validated['special_requests'],
            'booking_status' => 'pending',
            'payment_status' => 'pending',
            'total_amount' => $package->price * $validated['travelers_count'],
            'booking_reference' => 'BK-' . strtoupper(Str::random(8)),
        ]);

        // Redirect to payment process with success message
        return redirect()->route('customer.packages.book.payment', ['package' => $package->id, 'booking' => $booking->id])
            ->with('success', 'Booking created successfully! Please complete your payment.');
    }

    /**
     * Display the payment form for a booking
     * 
     * Shows the payment form where customers can enter their
     * payment information to complete their booking.
     * 
     * @param Package $package The package being booked (optional for backward compatibility)
     * @param Booking $booking The booking to pay for
     * @return View The payment form view
     */
    public function packageBookPayment(Package $package = null, Booking $booking = null): View
    {
        // Handle both route patterns: with package and without package
        if ($package && $booking) {
            // Called from the initial payment route
            $currentBooking = $booking;
        } elseif ($booking) {
            // Called from the regular payment route (backward compatibility)
            $currentBooking = $booking;
        } else {
            // Invalid call - no booking provided
            abort(404, 'Booking not found');
        }

        // Ensure the booking belongs to the authenticated user
        if ($currentBooking->user_id !== auth()->id()) {
            abort(403);
        }

        // Return the payment form view with the booking data
        return view('customer.package-book-payment', compact('currentBooking'));
    }

    /**
     * Process payment for a booking
     * 
     * Handles payment submission and updates the booking
     * status accordingly.
     * 
     * @param Request $request The HTTP request containing payment data
     * @param Package $package The package being booked
     * @param Booking $booking The booking to process payment for
     * @return RedirectResponse Redirect to success page or dashboard
     */
    public function processPayment(Request $request, Package $package, Booking $booking): RedirectResponse
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Validate the payment request data
        $validated = $request->validate([
            'card_number' => 'required|string|regex:/^[\d\s]{16,19}$/',
            'expiry_month' => 'required|integer|between:1,12',
            'expiry_year' => 'required|integer|min:' . date('Y'),
            'cvv' => 'required|string|regex:/^\d{3,4}$/',
            'cardholder_name' => 'required|string|max:255',
        ], [
            'card_number.regex' => 'The card number must be 16 digits (spaces allowed).',
            'cvv.regex' => 'The CVV must be 3 or 4 digits.',
        ]);

        // Strip spaces from card number for processing
        $validated['card_number'] = preg_replace('/\s+/', '', $validated['card_number']);

        // Validate final card number length after stripping spaces
        if (strlen($validated['card_number']) !== 16) {
            return back()->withErrors(['card_number' => 'The card number must be exactly 16 digits.'])->withInput();
        }

        // Simulate payment processing (in a real application, integrate with payment gateway)
        // For demo purposes, we'll mark the payment as successful
        $booking->update([
            'payment_status' => 'paid',
            'booking_status' => 'confirmed',
            'paid_at' => now(),
        ]);

        // Redirect to the booking success page
        return redirect()->route('customer.bookings.success', $booking)
            ->with('success', 'Payment processed successfully! Your booking is confirmed.');
    }

    /**
     * Display a specific booking for the customer
     * 
     * Shows detailed information about a customer's specific booking
     * including status, payment information, and package details.
     * 
     * @param Booking $booking The booking to display
     * @return View The booking detail view
     */
    public function bookingShow(Booking $booking): View
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Load the booking with its relationships
        $booking->load(['package', 'user']);

        // Return the booking detail view
        return view('customer.booking-show', compact('booking'));
    }

    /**
     * Cancel a customer's booking
     * 
     * Allows customers to cancel their bookings if they meet
     * certain criteria (e.g., not yet confirmed, within cancellation period).
     * 
     * @param Booking $booking The booking to cancel
     * @return RedirectResponse Redirect back to dashboard with message
     */
    public function cancelBooking(Booking $booking): RedirectResponse
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if the booking can be cancelled
        if ($booking->booking_status === 'confirmed' && $booking->payment_status === 'paid') {
            return redirect()->route('customer.dashboard')->with('error', 'Cannot cancel a confirmed and paid booking.');
        }

        // Update the booking status to cancelled
        $booking->update(['booking_status' => 'cancelled']);

        // Redirect back to dashboard with success message
        return redirect()->route('customer.dashboard')->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Download a PDF confirmation for a booking
     * 
     * Generates and downloads a PDF document containing the booking
     * confirmation details. This is available for confirmed and paid bookings.
     * 
     * @param Booking $booking The booking to generate PDF for
     * @return Response The PDF download response
     */
    public function downloadPdf(Booking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Use the PDF service to generate and download the confirmation
        return $this->pdfService->downloadBookingConfirmation($booking);
    }

    /**
     * Display the booking success page
     * 
     * Shows a congratulatory page after a successful booking and payment,
     * including booking details and next steps for the customer.
     * 
     * @param Booking $booking The successfully created booking
     * @return View The booking success view
     */
    public function bookingSuccess(Booking $booking): View
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Load the booking with its relationships for display
        $booking->load(['package', 'user']);

        // Return the success page view
        return view('customer.booking-success', compact('booking'));
    }

    /**
     * Display the customer profile page
     * 
     * Shows the customer's profile information, recent bookings,
     * and provides access to profile management functions.
     * 
     * @return View The customer profile view
     */
    public function profile(): View
    {
        // Get the authenticated user with their bookings
        $user = auth()->user();
        
        // Get user's recent bookings for display on profile
        $recentBookings = $user->bookings()
            ->with('package')
            ->latest()
            ->take(10)
            ->get();
        
        // Get booking statistics for profile overview
        $totalBookings = $user->bookings()->count();
        $confirmedBookings = $user->bookings()
            ->where('booking_status', 'confirmed')
            ->where('payment_status', 'paid')
            ->count();
        $pendingBookings = $user->bookings()
            ->where('booking_status', 'pending')
            ->count();
        $cancelledBookings = $user->bookings()
            ->where('booking_status', 'cancelled')
            ->count();
        
        // Get upcoming trips (confirmed bookings with future travel dates)
        $upcomingTrips = $user->bookings()
            ->with('package')
            ->where('booking_status', 'confirmed')
            ->where('payment_status', 'paid')
            ->where('travel_date', '>', now())
            ->orderBy('travel_date', 'asc')
            ->take(3)
            ->get();
        
        // Get upcoming trips count for statistics
        $upcomingTripsCount = $upcomingTrips->count();

        // Get completed trips (confirmed and paid bookings with past travel dates)
        $completedTrips = $user->bookings()
            ->where('booking_status', 'confirmed')
            ->where('payment_status', 'paid')
            ->where('travel_date', '<', now())
            ->count();
        
        // Calculate total amount spent on confirmed/paid bookings
        $totalSpent = $user->bookings()
            ->where('payment_status', 'paid')
            ->sum('total_amount');
        
        // Return the profile view with user data and statistics
        return view('customer.profile', compact(
            'user',
            'recentBookings',
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'cancelledBookings',
            'upcomingTrips',
            'completedTrips',
            'totalSpent'
        ));
    }
}
