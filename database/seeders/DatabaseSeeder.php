<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
        ]);
        
        // Create admin user
        $admin = \App\Models\User::create([
            'name' => 'Flower Admin',
            'email' => 'admin@flowers.com',
            'password' => bcrypt('secret123'),
        ]);
        $admin->assignRole('admin');
        
    }
}