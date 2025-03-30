<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // 1. Define CORE permissions (including dashboard)
        $permissions = [
            'view_dashboard', // THIS IS THE CRUCIAL ONE
            'manage_users',
            'view_causes',
            'create_causes',
            'edit_causes',
            'delete_causes',
            'view_donations',
            'export_donations',
            'manage_settings'
        ];

        // 2. Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // 3. Create Super Admin (gets ALL permissions)
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        // 4. Assign specific permissions to other roles
        $roles = [
            'Admin' => [
                'view_dashboard', // Admins can access dashboard
                'manage_users',
                'view_causes',
                'create_causes',
                'edit_causes',
                'view_donations'
            ],
            'Editor' => [
                'view_causes',
                'create_causes',
                'edit_causes'
            ],
            'Finance' => [
                'view_dashboard', // Finance can access dashboard
                'view_donations',
                'export_donations'
            ]
        ];

        foreach ($roles as $name => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
            $role->syncPermissions($rolePermissions);
        }
    }
}
