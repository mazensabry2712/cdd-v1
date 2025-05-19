<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create role if not exists
        $role = Role::firstOrCreate(['name' => 'owner']);

        // Get all permissions and assign to role
        $permissions = Permission::all();
        if ($permissions->isNotEmpty()) {
            $role->syncPermissions($permissions);
        }

        // Create user if not exists
        $user = User::firstOrCreate(
            ['email' => 'admin010055@admin.com'],
            [
                'name'     => 'admin',
                'password' => Hash::make('admin010055@admin.com010055'),
                'status'   => 'active',
                'roles_name' => json_encode(['owner']),
            ]
        );

        // Assign role to user if not already assigned
        if (!$user->hasRole('owner')) {
            $user->assignRole($role);
        }
    }
}
