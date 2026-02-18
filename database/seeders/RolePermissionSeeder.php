<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'access admin dashboard',
            'manage books',
            'view books',
            'create books',
            'edit books',
            'delete books',
            'borrow books',
            'view transactions',
            'manage roles',
            'manage categories',

        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Fetch roles (web guard)
        $admin = Role::where('name', 'admin')->where('guard_name', 'web')->first();
        $librarian = Role::where('name', 'librarian')->where('guard_name', 'web')->first();
        $user = Role::where('name', 'user')->where('guard_name', 'web')->first();

        if ($admin) {
            $admin->syncPermissions($permissions);
        }

        if ($librarian) {
            $librarian->syncPermissions([
                'manage books',
                'create books',
                'edit books',
                'view transactions',
            ]);
        }

        if ($user) {
            $user->syncPermissions([
                'borrow books',
                'view books',
            ]);
        }
    }
}
