<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definisikan permissions
        $permissions = [
            'read',
            'create',
            'update',
            'delete',
            'print',
            'report'
        ];

        // Buat permissions jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat dan assign permissions ke role
        // Superadmin TI - Full Access
        $superadminTI = Role::firstOrCreate(['name' => 'superadmin_ti']);
        $superadminTI->syncPermissions(Permission::all());

        // Staff Operator - Read & Create
        $staffOperator = Role::firstOrCreate(['name' => 'staff_operator']);
        $staffOperator->syncPermissions(['read', 'create']);

        // Staff Admin - Read, Create, Update, Print
        $staffAdmin = Role::firstOrCreate(['name' => 'staff_admin']);
        $staffAdmin->syncPermissions(['read', 'create', 'update', 'print']);

        // Optional: Buat user contoh dengan role (untuk testing)
        // $superadminUser = User::firstOrCreate(
        //     ['email' => 'superadmin@example.com'],
        //     [
        //         'name' => 'Superadmin TI',
        //         'password' => bcrypt('password'),
        //         'role' => 'superadmin_ti', // Sesuai kolom role di model User
        //     ]
        // );
        // $superadminUser->assignRole('superadmin_ti');

        // $operatorUser = User::firstOrCreate(
        //     ['email' => 'operator@example.com'],
        //     [
        //         'name' => 'Staff Operator',
        //         'password' => bcrypt('password'),
        //         'role' => 'staff_operator',
        //     ]
        // );
        // $operatorUser->assignRole('staff_operator');

        // $adminUser = User::firstOrCreate(
        //     ['email' => 'admin@example.com'],
        //     [
        //         'name' => 'Staff Admin',
        //         'password' => bcrypt('password'),
        //         'role' => 'staff_admin',
        //     ]
        // );
        // $adminUser->assignRole('staff_admin');
    }
}