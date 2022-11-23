<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the database? This removes all existing data stored in the current database!'))
        {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');

        }

        $this->call([
        PermissionRoleSeeder::class,
        UserSeeder::class,
        ProfileSeeder::class, 
        OrganisationSeeder::class,
        AccountSeeder::class,
        TransactionSeeder::class,
        ]);

        $this->command->info('Super-Admin user: admin@admin.com');
        $this->command->info('Super-Admin password: SecurePassword');
        $this->command->info('All other users have password: password');

    }
}
