<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user with superadmin_ti role
        $adminUser = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Superadmiin TI',
                'password' => Hash::make('password123'),
            ]
        );
        $adminUser->assignRole('superadmin_ti');

        // Regular user with staff_operator role
        $regularUser = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password123'),
            ]
        );
        $regularUser->assignRole('staff_operator');
    }
}
