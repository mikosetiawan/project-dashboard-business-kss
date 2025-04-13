<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            MenuSeeder::class,
            UserSeeder::class,
        ]);

        // $users = User::create([
        //     'name' => 'Superadmin TI',
        //     'email' => 'superadmin_ti@example.com',
        //     'password' => bcrypt('password123')
        // ]);
        // $users->assignRole('superadmin_ti');
    }
}
