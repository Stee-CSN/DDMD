<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        // Create or update super admin
        User::updateOrCreate(
            ['email' => 'admin@yosel.bt'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@yosel.bt',
                'password' => Hash::make('password123'),
                'is_admin' => 1,
                'role' => 'super_admin',
                'status' => 'active',
                'phone' => '77827571',
                'address' => 'Dewathang, Samdrup Jongkhar',
            ]
        );
        
        // Create a regular admin for testing
        User::updateOrCreate(
            ['email' => 'admin2@yosel.bt'],
            [
                'name' => 'Regular Admin',
                'email' => 'admin2@yosel.bt',
                'password' => Hash::make('password123'),
                'is_admin' => 1,
                'role' => 'admin',
                'status' => 'active',
                'phone' => '77299776',
            ]
        );
        
        // Create a regular user
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => 0,
                'role' => 'user',
                'status' => 'active',
            ]
        );
    }
}