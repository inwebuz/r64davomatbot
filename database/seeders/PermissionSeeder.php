<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainPermissionGroup = PermissionGroup::create(['name' => 'Main']);
        $mainPermissions = [
            'browse-admin',
            'browse-stats'
        ];
        foreach ($mainPermissions as $value) {
            Permission::updateOrCreate([
                'permission_group_id' => $mainPermissionGroup->id,
                'name' => $value,
            ]);
        }
        $permissionGroups = [
            'employees',
            'work-hours',
            'users',
        ];
        foreach ($permissionGroups as $value) {
            $permissionGroup = PermissionGroup::updateOrCreate(['name' => $value]);
            foreach (['create', 'read', 'update', 'delete'] as $value1) {
                Permission::updateOrCreate([
                    'permission_group_id' => $permissionGroup->id,
                    'name' => "{$value1}-{$value}",
                ]);
            }
        }

        $admin = Role::where('name', 'admin')->first();
        $employee = Role::where('name', 'employee')->first();
        $user = Role::where('name', 'user')->first();

        $allPermissions = Permission::all();
        $admin->syncPermissions($allPermissions);
    }
}
