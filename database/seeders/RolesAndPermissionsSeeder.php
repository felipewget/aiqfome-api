<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $clientPermissions = [
            'list_favorites',
            'add_favorites',
            'remove_favorites',
            'get_personal_data'
        ];

        $adminPermissions = [
            'list_users',
            'create_users',
            'remove_users',
            'update_users',
        ];
        
        foreach (array_merge($clientPermissions, $adminPermissions) as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        }
        
        $clientRole = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'api']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        
        $clientRole->syncPermissions($clientPermissions);
        $adminRole->syncPermissions($adminPermissions);
    }
}
