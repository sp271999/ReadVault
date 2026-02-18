<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles with explicit guard_name
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $user  = Role::firstOrCreate(['name' => 'user',  'guard_name' => 'web']);
        $librarian = Role::firstOrCreate(['name' => 'librarian', 'guard_name' => 'web']);

       
    }
}
