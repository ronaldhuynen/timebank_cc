<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     * To re-seed this PermissionRoleSeeder after any changes use:
     * php artisan db:seed --class=PermissionRoleSeeder
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Disable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the tables in case you are re-seeding
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        // Comment line below to preserve the existing roles attached to the models
        //DB::table('model_has_roles')->truncate();
        // Comment line below to preserve the existing permissions attached to the  models
        //DB::table('model_has_permissions')->truncate();

        // Re-enable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // create permissions
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'update posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'unpublish posts']);
        Permission::create(['name' => 'manage posts']); // all permissions regarding posts

        Permission::create(['name' => 'create tags']);
        Permission::create(['name' => 'update tags']);
        Permission::create(['name' => 'delete tags']);
        Permission::create(['name' => 'manage tags']); // all permissions regarding tags

        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);
        Permission::create(['name' => 'manage categories']); // all permissions regarding categories

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

        Permission::create(['name' => 'manage permissions']); // all permissions regarding permissions
        Permission::create(['name' => 'manage roles']); // all permissions regarding roles

        // create roles and assign existing permissions
        $siteEditor = Role::create(['name' => 'Site-editor']);
        $siteEditor->givePermissionTo('manage posts');
        $siteEditor->givePermissionTo('manage tags');
        $siteEditor->givePermissionTo('manage categories');

        $bankAdmin = Role::create(['name' => 'Bank-manager']);
        $bankAdmin->givePermissionTo('manage users');
        $bankAdmin->givePermissionTo('manage user_projects');
        $bankAdmin->givePermissionTo('manage organizations');

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo('manage posts');
        $admin->givePermissionTo('manage tags');
        $admin->givePermissionTo('manage categories');
        $admin->givePermissionTo('manage users');
        $admin->givePermissionTo('manage user_projects');
        $admin->givePermissionTo('manage organizations');
        $admin->givePermissionTo('manage banks');
        $admin->givePermissionTo('manage admins');
        $admin->givePermissionTo('manage permissions');
        $admin->givePermissionTo('manage roles');


        $superAdmin = Role::create(['name' => 'Super-admin']);
        // Gets all permissions via Gate::before rule; see AuthServiceProvider


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
