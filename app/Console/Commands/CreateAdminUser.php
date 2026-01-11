<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user {--force : Force create even if admin exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user with proper roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // List existing users and their roles
        $this->info('Existing users:');
        $users = User::with('roles')->get();

        if ($users->isEmpty()) {
            $this->info('No users found.');
        } else {
            foreach ($users as $user) {
                $roles = $user->roles->pluck('name')->join(', ') ?: 'No roles';
                $this->line("- {$user->name} ({$user->email}) - Roles: {$roles}");
            }
        }

        // Check if admin role exists
        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            $this->error('Admin role does not exist. Please run database seeder first.');
            return;
        }

        // Check if admin user exists
        $adminUser = User::where('email', 'admin@thambapanni.com')->first();

        if ($adminUser && !$this->option('force')) {
            $this->info('Admin user already exists.');

            // Check if user has admin role
            if (!$adminUser->hasRole('admin')) {
                $this->info('Assigning admin role to existing user...');
                $adminUser->assignRole('admin');
                $this->info('Admin role assigned successfully!');
            } else {
                $this->info('User already has admin role.');
            }
            return;
        }

        // Create or update admin user
        if ($adminUser && $this->option('force')) {
            $this->info('Updating existing admin user...');
            $adminUser->update([
                'password' => bcrypt('password'),
                'email_verified_at' => now()
            ]);
        } else {
            $this->info('Creating new admin user...');
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'admin@thambapanni.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now()
            ]);
        }

        // Assign admin role
        $adminUser->assignRole('admin');

        $this->info('Admin user created/updated successfully!');
        $this->info('Email: admin@thambapanni.com');
        $this->info('Password: password');
    }
}
