<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $supplierRole = Role::firstOrCreate(['name' => 'supplier']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);

        // Create a user or find existing one
        $user = User::firstOrCreate(
            ['email' => 'fiora@admin.com'],
            ['name' => 'Admin User', 'password' => bcrypt('FiorA#852')]
        );

        // Assign role
        $user->assignRole('admin');
    }
}
