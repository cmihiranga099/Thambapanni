<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);

        // Create permissions
        $permissions = [
            'view packages',
            'create packages',
            'edit packages',
            'delete packages',
            'view bookings',
            'manage bookings',
            'view customers',
            'manage customers',
            'view contacts',
            'manage contacts',
            'view reports',
            'book packages',
            'manage own bookings',
            'make payments'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to admin role
        $adminRole->givePermissionTo($permissions);

        // Assign permissions to customer role
        $customerRole->givePermissionTo([
            'view packages',
            'book packages',
            'manage own bookings',
            'make payments'
        ]);
    }
}
