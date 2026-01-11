<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/packages', [HomeController::class, 'packages'])->name('packages');
Route::get('/packages/{package}', [HomeController::class, 'packageShow'])->name('packages.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactStore'])->name('contact.store');

// Test route for PDF generation (remove in production)
Route::get('/test-pdf', function () {
    $booking = \App\Models\Booking::with(['package', 'user'])->first();
    if ($booking) {
        $pdfService = new \App\Services\BookingPdfService();
        return $pdfService->downloadBookingConfirmation($booking);
    }
    return 'No bookings found';
});

// Welcome route (optional - you can remove this if not needed)
Route::get('/welcome', function () {
    return view('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard route (optional - you can remove this if not needed)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('packages', PackageController::class);
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings.index');
    Route::put('/bookings/{booking}', [AdminController::class, 'bookingsUpdate'])->name('bookings.update');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts.index');
    Route::put('/contacts/{contact}', [AdminController::class, 'contactsUpdate'])->name('contacts.update');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers.index');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

// Customer routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/packages', [CustomerController::class, 'packages'])->name('packages');
    Route::get('/packages/{package}', [CustomerController::class, 'packageShow'])->name('packages.show');
    Route::get('/packages/{package}/book', [CustomerController::class, 'packageBook'])->name('packages.book');
    Route::post('/packages/{package}/book', [CustomerController::class, 'packageBookStore'])->name('packages.book.store');
    Route::get('/packages/{package}/book/{booking}/payment', [CustomerController::class, 'packageBookPayment'])->name('packages.book.payment');
    Route::post('/packages/{package}/book/{booking}/payment', [CustomerController::class, 'processPayment'])->name('packages.book.payment.process');
    Route::get('/bookings', [CustomerController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/{booking}', [CustomerController::class, 'bookingShow'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [CustomerController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::get('/bookings/{booking}/pdf', [CustomerController::class, 'downloadPdf'])->name('bookings.pdf');
    Route::get('/bookings/{booking}/success', [CustomerController::class, 'bookingSuccess'])->name('bookings.success');
});

require __DIR__.'/auth.php';
