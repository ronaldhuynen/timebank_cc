<?php

namespace Database\Seeders;

use App\Http\Controllers\SearchIndexController;
use App\Models\Locations\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
            $this->command->info('Database was refreshed');

            // Remove all files in the "profile-photos" directory
            Storage::disk('public')->deleteDirectory('profile-photos');
            Storage::disk('public')->makeDirectory('profile-photos');
            $this->command->info('All files in "profile-photos" have been removed.');

            $this->call([PermissionRoleSeeder::class]);
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

            // Seed Super-Admin with user id 1
            $admin = User::factory()->create([
                'name' => 'Super-Admin',
                'full_name' => 'Super Administrator',
                'email' => 'admin@test.nl',
                'password' => bcrypt('SecurePassword'),  // Super-Admin password: 'SecurePassword'
                'profile_photo_path' => 'app-images/profile-user-default.svg',
            ]);

            $location = new Location(['city_id' => 305, 'division_id' => 12, 'country_id' => 1]);
            $admin->locations()->save($location);

            $admin->assignRole('Super-Admin');

            $this->call(LoveReactionTypesTableSeeder::class);
        }

        $this->call([
        TestUserSeeder::class,
        UserSeeder::class,
        OrganizationSeeder::class,
        TransactionSeeder::class,
        ]);

        if ($this->command->confirm('Do you want to seed the sample tags?')) {
            $this->call(TaggableTagsTableSeeder::class);
            $this->call(TaggableLocalesTableSeeder::class);
            $this->call(TaggableContextsTableSeeder::class);
            $this->call(TaggableLocaleContextTableSeeder::class);
        }

        if($this->command->confirm('Do you want to (re-) create the Elasticsearch index? (This removes all existing data stored in the current index!)')) {
            $elasticsearchService = new SearchIndexController();
        }
        $this->command->info('Super-Admin email and password: admin@test.nl, SecurePassword');
        $this->command->info('All other users have password: password');

    }
}
