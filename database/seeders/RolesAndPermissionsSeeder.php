<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $adminRole = Role::create(['name' => 'admin']);
        $hrRole = Role::create(['name' => 'hr']);
        $managerRole = Role::create(['name' => 'manager']);
        $employeeRole = Role::create(['name' => 'employee']);

        $manageEmployees = Permission::create(['name' => 'manage employees']);
        $manageDepartments = Permission::create(['name' => 'manage departments']);
        $manageHierarchy = Permission::create(['name' => 'manage hierarchy']);

        $adminRole->givePermissionTo([$manageEmployees, $manageDepartments, $manageHierarchy]);
        $hrRole->givePermissionTo([$manageEmployees]);
        $managerRole->givePermissionTo([$manageDepartments]);
    }
}
