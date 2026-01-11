<?php

namespace App\Services;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

/**
 * BookingPdfService
 * 
 * This service class handles the generation, storage, and download of PDF documents
 * for booking confirmations. It provides a centralized way to manage PDF operations
 * related to travel bookings.
 * 
 * Features:
 * - Generate PDF from Blade templates
 * - Store PDFs temporarily with automatic cleanup
 * - Download PDFs directly to user's browser
 * - Error handling and logging
 * - Temporary file management
 * 
 * Dependencies:
 * - barryvdh/laravel-dompdf for PDF generation
 * - Laravel Storage facade for file management
 * - Laravel Log facade for error logging
 */
class BookingPdfService
{
    /**
     * Generate a booking confirmation PDF and store it temporarily
     * 
     * This method creates a PDF document from a Blade template containing
     * booking details, stores it in a temporary location, and returns the
     * file path for further processing.
     * 
     * @param Booking $booking The booking model to generate PDF for
     * @return string The path to the generated PDF file
     * @throws \Exception If PDF generation or storage fails
     */
    public function generateBookingConfirmation(Booking $booking): string
    {
        try {
            // Load the booking with its relationships for PDF content
            $booking->load(['package', 'user']);
            
            // Generate PDF from the Blade template
            // The template includes booking details, traveler info, and package information
            $pdf = Pdf::loadView('pdfs.booking-confirmation', compact('booking'));
            
            // Configure PDF settings for optimal display and printing
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Arial'
            ]);
            
            // Generate unique filename using booking ID and timestamp
            $filename = 'booking_' . $booking->id . '_' . time() . '.pdf';
            
            // Store PDF in temporary directory with automatic cleanup
            $path = 'temp/' . $filename;
            Storage::disk('public')->put($path, $pdf->output());
            
            // Return the full path for further use
            return $path;
            
        } catch (\Exception $e) {
            // Log the error for debugging and monitoring
            Log::error('PDF generation failed for booking ' . $booking->id, [
                'error' => $e->getMessage(),
                'booking' => $booking->toArray(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Re-throw the exception to be handled by the calling code
            throw $e;
        }
    }

    /**
     * Generate and download a booking confirmation PDF
     * 
     * This method creates a PDF document and immediately triggers a download
     * in the user's browser. It's useful for direct PDF downloads without
     * storing the file permanently.
     * 
     * @param Booking $booking The booking model to generate PDF for
     * @return Response The HTTP response containing the PDF download
     * @throws \Exception If PDF generation fails
     */
    public function downloadBookingConfirmation(Booking $booking): Response
    {
        try {
            // Load the booking with its relationships for PDF content
            $booking->load(['package', 'user']);
            
            // Generate PDF from the Blade template
            $pdf = Pdf::loadView('pdfs.booking-confirmation', compact('booking'));
            
            // Configure PDF settings for optimal display and printing
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Arial'
            ]);
            
            // Generate filename for download
            $filename = 'booking_confirmation_' . $booking->id . '.pdf';
            
            // Return PDF as download response
            // This triggers the browser to download the file with the specified filename
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            // Log the error for debugging and monitoring
            Log::error('PDF download failed for booking ' . $booking->id, [
                'error' => $e->getMessage(),
                'booking' => $booking->toArray(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Re-throw the exception to be handled by the calling code
            throw $e;
        }
    }

    /**
     * Clean up temporary PDF files older than 1 hour
     * 
     * This method removes temporary PDF files that are no longer needed,
     * helping to manage disk space and prevent accumulation of old files.
     * It's designed to be called periodically (e.g., via scheduled tasks).
     * 
     * @return int The number of files removed
     */
    public function cleanupTempFiles(): int
    {
        try {
            $removedCount = 0;
            
            // Get all files in the temp directory
            $files = Storage::disk('public')->files('temp');
            
            // Calculate cutoff time (1 hour ago)
            $cutoffTime = time() - 3600; // 3600 seconds = 1 hour
            
            foreach ($files as $file) {
                // Get file modification time
                $lastModified = Storage::disk('public')->lastModified($file);
                
                // Remove files older than 1 hour
                if ($lastModified < $cutoffTime) {
                    Storage::disk('public')->delete($file);
                    $removedCount++;
                    
                    // Log cleanup activity for monitoring
                    Log::info('Cleaned up temporary PDF file: ' . $file);
                }
            }
            
            // Log summary of cleanup operation
            if ($removedCount > 0) {
                Log::info("PDF cleanup completed: {$removedCount} files removed");
            }
            
            return $removedCount;
            
        } catch (\Exception $e) {
            // Log cleanup errors for debugging
            Log::error('PDF cleanup failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return 0 to indicate no files were removed due to error
            return 0;
        }
    }
}


