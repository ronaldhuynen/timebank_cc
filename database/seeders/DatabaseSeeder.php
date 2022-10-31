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
        if ($this->command->confirm('Do you want to refresh the database?'))
        {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');

        }

        $this->call([
        UserSeeder::class,
        ProfileSeeder::class,
        OrganisationSeeder::class,
        AccountSeeder::class,
        TransactionSeeder::class,
        ]);

        $this->command->info('You can login with: ronald@test.nl');
        $this->command->info('All users have password: password');

    }
}
