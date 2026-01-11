<?php

namespace App\Console\Commands;

use App\Services\BookingPdfService;
use Illuminate\Console\Command;

/**
 * CleanupTempPdfs Command
 * 
 * This Artisan command cleans up temporary PDF files that are older than 1 hour.
 * It helps manage disk space by removing PDF files that are no longer needed
 * after being generated and downloaded by users.
 * 
 * Usage: php artisan pdfs:cleanup
 * 
 * Features:
 * - Removes temporary PDF files older than 1 hour
 * - Reports the number of files removed
 * - Integrates with BookingPdfService for cleanup operations
 * - Can be scheduled to run automatically
 * 
 * Scheduling:
 * Add to app/Console/Kernel.php to run automatically:
 * $schedule->command('pdfs:cleanup')->hourly();
 */
class CleanupTempPdfs extends Command
{
    /**
     * The name and signature of the console command
     * 
     * @var string
     */
    protected $signature = 'pdfs:cleanup';

    /**
     * The console command description
     * 
     * @var string
     */
    protected $description = 'Clean up temporary PDF files older than 1 hour';

    /**
     * Execute the console command
     * 
     * This method is called when the command is executed. It:
     * 1. Calls the cleanup method from BookingPdfService
     * 2. Reports the results of the cleanup operation
     * 3. Provides feedback to the user about the operation
     * 
     * @return int Command exit code (0 for success)
     */
    public function handle()
    {
        // Display start message to inform user of command execution
        $this->info('Starting cleanup of temporary PDF files...');
        
        try {
            // Get the BookingPdfService instance through dependency injection
            $pdfService = app(BookingPdfService::class);
            
            // Call the cleanup method to remove old temporary files
            $removedCount = $pdfService->cleanupTempFiles();
            
            // Report the results of the cleanup operation
            if ($removedCount > 0) {
                $this->info("Cleanup completed successfully! {$removedCount} temporary PDF files were removed.");
            } else {
                $this->info('Cleanup completed! No temporary PDF files were found or removed.');
            }
            
            // Return success exit code
            return 0;
            
        } catch (\Exception $e) {
            // Display error message if cleanup fails
            $this->error('Cleanup failed: ' . $e->getMessage());
            
            // Log the error for debugging and monitoring
            \Log::error('PDF cleanup command failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return error exit code
            return 1;
        }
    }
}
