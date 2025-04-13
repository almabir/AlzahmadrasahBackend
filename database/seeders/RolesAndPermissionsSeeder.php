<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'manage users']);

        // Create roles and assign created permissions
        $role1 = Role::create(['name' => 'viewer']);
        $role2 = Role::create(['name' => 'moderator']);
        $role3 = Role::create(['name' => 'editor']);
        $role4 = Role::create(['name' => 'admin']);
        $role5 = Role::create(['name' => 'super-admin']);

        $role2->givePermissionTo(['edit articles', 'delete articles']);
        $role3->givePermissionTo(['edit articles', 'publish articles']);
        $role4->givePermissionTo(Permission::all());
        $role5->givePermissionTo(Permission::all());

        // Assign super-admin role to a user (e.g., user with ID 1)
        $user = \App\Models\User::find(1);
        if ($user) {
            $user->assignRole($role5);
        }
    }
}