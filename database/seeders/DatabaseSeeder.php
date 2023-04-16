<?php

namespace Database\Seeders;

use App\Models\User;
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
            $this->command->call('db:wipe');
            $this->command->call('migrate:refresh');
            $this->call([PermissionRoleSeeder::class]);

            // Seed Super-Admin with user id 1
            $admin = User::factory()->create([
                'name' => 'Super-Admin',
                'email' => 'admin@admin.com',
                'locale_website' => 'en',
                'password' => bcrypt('SecurePassword'),  // Super-Admin password: 'SecurePassword'
            ]);
            $admin->assignRole('Super-Admin');

        $this->command->info('Database was refreshed');
        $this->call(CountriesTableSeeder::class);
        $this->call(CountryLocalesTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        $this->call(DivisionLocalesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CityLocalesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(DistrictLocalesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(LanguageCompetencesTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(CountryLanguagesTableSeeder::class);
    }

        $this->call([
        TestUserSeeder::class,
        UserSeeder::class,
        OrganisationSeeder::class,
        TransactionSeeder::class,
        ]);

        $this->command->info('Super-Admin user: admin@admin.com');
        $this->command->info('Super-Admin password: SecurePassword');
        $this->command->info('All other users have password: password');

    }
}
