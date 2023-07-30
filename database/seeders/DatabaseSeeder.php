<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the database? This removes all existing data stored in the current database!')) {
            $this->command->call('db:wipe');
            $this->command->call('migrate:refresh');
            $this->call([PermissionRoleSeeder::class]);

            // Seed Super-Admin with user id 1
            $admin = User::factory()->create([
                'name' => 'Super-Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('SecurePassword'),  // Super-Admin password: 'SecurePassword'
                'profile_photo_path' => 'app-images/profile-user-default.svg',
            ]);

            DB::table('locationables')->insert([
                            'location_id' => 1,
                            'locationable_type' => User::class,
                            'locationable_id' => 1]);

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
            $this->call(SocialsTableSeeder::class);
            $this->call(CountryLanguagesTableSeeder::class);
            $this->call(PostsTableSeeder::class);
            $this->call(PostTranslationsTableSeeder::class);
            $this->call(CategoriesTableSeeder::class);
            $this->call(CategoryTranslationsTableSeeder::class);
            $this->call(MeetingsTableSeeder::class);
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
