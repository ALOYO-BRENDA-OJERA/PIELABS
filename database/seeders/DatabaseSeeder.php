<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; // THIS WAS THE MISSING IMPORT

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. FIRST create all roles and permissions
        $this->call(RoleSeeder::class);

        // 2. THEN create the Super Admin user
        $this->createSuperAdmin();

        // 3. ONLY in local/dev: Create test users
        if (app()->environment('local')) {
            $this->createTestUsers();
        }
    }

    protected function createSuperAdmin()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'SuperSecret123!')),
                'email_verified_at' => now(),
            ]
        );

        if ($superAdminRole = Role::where('name', 'Super Admin')->first()) {
            $admin->assignRole($superAdminRole);
            $admin->syncPermissions(Permission::all()); // Now works with the import
            logger()->info('Super Admin created with all permissions');
        } else {
            logger()->error('Super Admin role missing! Run RoleSeeder first.');
        }
    }

    protected function createTestUsers()
    {
        // Sample Admin user
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Test Admin',
                'password' => Hash::make('Admin123!'),
                'email_verified_at' => now(),
            ]
        )->assignRole('Admin');

        // Sample regular user
        User::firstOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('User123!'),
                'email_verified_at' => now(),
            ]
        );

        // Generate random users
        User::factory(5)->create()->each(function ($user) {
            $user->assignRole(
                Role::where('name', '!=', 'Super Admin')
                    ->inRandomOrder()
                    ->first()
            );
        });
    }
}
