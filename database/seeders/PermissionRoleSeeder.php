<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'update posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'unpublish posts']);
        Permission::create(['name' => 'manage posts']); // all permissions regarding posts

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'manage users']); // all permissions regarding users

        Permission::create(['name' => 'create user_projects']);
        Permission::create(['name' => 'update user_projects']);
        Permission::create(['name' => 'delete user_projects']);
        Permission::create(['name' => 'manage user_projects']); // all permissions regarding user_projects

        Permission::create(['name' => 'create organizations']);
        Permission::create(['name' => 'update organizations']);
        Permission::create(['name' => 'delete organizations']);
        Permission::create(['name' => 'manage organizations']); // all permissions regarding organizations

        Permission::create(['name' => 'create banks']);
        Permission::create(['name' => 'update banks']);
        Permission::create(['name' => 'delete banks']);
        Permission::create(['name' => 'manage banks']); // all permissions regarding banks

        Permission::create(['name' => 'create admins']);
        Permission::create(['name' => 'update admins']);
        Permission::create(['name' => 'delete admins']);
        Permission::create(['name' => 'manage admins']); // all permissions regarding admins


        // create roles and assign existing permissions
        $siteEditor = Role::create(['name' => 'Site-editor']);
        $siteEditor->givePermissionTo('create posts');
        $siteEditor->givePermissionTo('update posts');
        $siteEditor->givePermissionTo('delete posts');
        $siteEditor->givePermissionTo('publish posts');
        $siteEditor->givePermissionTo('unpublish posts');
        $siteEditor->givePermissionTo('manage posts');

        $bankAdmin = Role::create(['name' => 'Bank-admin']);
        $bankAdmin->givePermissionTo('create users');
        $bankAdmin->givePermissionTo('update users');
        $bankAdmin->givePermissionTo('delete users');
        $bankAdmin->givePermissionTo('manage users');
        $bankAdmin->givePermissionTo('create user-projects');
        $bankAdmin->givePermissionTo('update user-projects');
        $bankAdmin->givePermissionTo('delete user-projects');
        $bankAdmin->givePermissionTo('manage user-projects');
        $bankAdmin->givePermissionTo('create organizations');
        $bankAdmin->givePermissionTo('update organizations');
        $bankAdmin->givePermissionTo('delete organizations');
        $bankAdmin->givePermissionTo('manage organizations');
        
        $admin = Role::create(['name' => 'Admin']);
        $bankAdmin->givePermissionTo('create banks');
        $bankAdmin->givePermissionTo('update banks');
        $bankAdmin->givePermissionTo('delete banks');
        $bankAdmin->givePermissionTo('manage banks');
        $bankAdmin->givePermissionTo('create admins');
        $bankAdmin->givePermissionTo('update admins');
        $bankAdmin->givePermissionTo('delete admins');
        $bankAdmin->givePermissionTo('manage admins');

        $superAdmin = Role::create(['name' => 'Super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider


        // // create demo users
        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example User',
        //     'email' => 'test@example.com',
        // ]);
        // $user->assignRole($siteEditor);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example Admin User',
        //     'email' => 'admin@example.com',
        // ]);
        // $user->assignRole($bankAdmin);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example Super-Admin User',
        //     'email' => 'superadmin@example.com',
        // ]);
        // $user->assignRole($role3);
    }
}
