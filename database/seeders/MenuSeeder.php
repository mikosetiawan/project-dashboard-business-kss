<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Permission;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Daftar menu yang akan ditambahkan
        $menus = [
            [
                'name' => 'Dashboard',
                'route' => 'dashboard.index',
                'icon' => 'fa-tachometer-alt',
                'order' => 1,
                'permissions' => ['read'],
            ],
            [
                'name' => 'Report',
                'route' => 'report.index',
                'icon' => 'fa-file-alt',
                'order' => 3,
                'permissions' => ['read', 'create', 'update', 'print'],
            ],
            [
                'name' => 'Register',
                'route' => 'register.index',
                'icon' => 'fa-file-alt',
                'order' => 3,
                'permissions' => ['read', 'create', 'update', 'print'],
            ],
        ];

        // Looping untuk membuat menu dan permission-nya
        foreach ($menus as $menuData) {
            // Buat menu
            $menu = Menu::create([
                'name' => $menuData['name'],
                'route' => $menuData['route'],
                'icon' => $menuData['icon'],
                'order' => $menuData['order'],
            ]);

            // Buat permission khusus untuk menu ini
            foreach ($menuData['permissions'] as $permission) {
                $permissionName = "{$permission} {$menuData['name']}"; // Contoh: "read Dashboard"
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        // Assign permission ke role yang sudah ada
        $this->assignPermissionsToRoles();
    }

    private function assignPermissionsToRoles()
    {
        $superadminTi = \Spatie\Permission\Models\Role::findByName('superadmin_ti');
        $staffOperator = \Spatie\Permission\Models\Role::findByName('staff_operator');
        $staffAdmin = \Spatie\Permission\Models\Role::findByName('staff_admin');

        // Superadmin TI dapat semua permission
        $superadminTi->givePermissionTo(Permission::all());

        // Staff Operator: read Dashboard, read Reports
        $staffOperator->givePermissionTo([
            'read Dashboard',
            'read Report',
        ]);

        // Staff Admin: read semua menu, create/update Users, print Reports
        $staffAdmin->givePermissionTo([
            'read Dashboard',
            'read Report',
            'create Report',
            'update Report',
        ]);
    }
}