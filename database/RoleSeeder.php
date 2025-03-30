<?php
// database/seeders/RoleSeeder.php
namespace Database\Seeders; // Add the namespace

use Illuminate\Database\Seeder; // Import the Seeder class
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Super Admin' => ['view_dashboard', 'manage_users', 'view_causes', 'create_causes', 'view_donations', 'export_donations'],
            'Admin' => ['view_dashboard', 'view_causes', 'create_causes', 'view_donations'],
            'Editor' => ['view_causes', 'create_causes'],
            'Finance Manager' => ['view_donations', 'export_donations'],
        ];

        foreach ($roles as $role => $permissions) {
            $role = Role::create(['name' => $role]);
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
