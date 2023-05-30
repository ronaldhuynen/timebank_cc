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
        Permission::create(['name' => 'create site articles']);
        Permission::create(['name' => 'update site articles']);
        Permission::create(['name' => 'delete site articles']);
        Permission::create(['name' => 'publish site articles']);
        Permission::create(['name' => 'unpublish site articles']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'manage users']); // export lists, CRUD personal data (email)

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Site-Editor']);
        $role1->givePermissionTo('create site articles');
        $role1->givePermissionTo('update site articles');
        $role1->givePermissionTo('delete site articles');
        $role1->givePermissionTo('publish site articles');
        $role1->givePermissionTo('unpublish site articles');

        $role2 = Role::create(['name' => 'Bank-Admin']);
        $role2->givePermissionTo('create users');
        $role2->givePermissionTo('update users');
        $role2->givePermissionTo('delete users');
        $role2->givePermissionTo('manage users');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider


        // // create demo users
        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example User',
        //     'email' => 'test@example.com',
        // ]);
        // $user->assignRole($role1);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example Admin User',
        //     'email' => 'admin@example.com',
        // ]);
        // $user->assignRole($role2);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example Super-Admin User',
        //     'email' => 'superadmin@example.com',
        // ]);
        // $user->assignRole($role3);
    }
}
