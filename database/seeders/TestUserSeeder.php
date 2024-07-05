<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Locations\Location;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to seed the test users and organizations?')) {

            $user1 = User::factory()
                ->has(Account::factory()->state(['name' => 'Personal Account']))
                ->has(Location::factory()->state(['city_id' => 305, 'division_id' => 12, 'country_id' => 1]))
                ->create([
                    'name' => 'Ronald',
                    'full_name' => 'Ronald Huynen',
                    'email' => 'ronald@test.nl',
                    'profile_photo_path' => 'profile-photos/0gs4OCq7MYEiZUzXBKuNfTbD8kByYjhtjalSEZWj.png',
                    'password' => bcrypt('password'),
                    ]);

            $user2 = User::factory()
                ->has(Account::factory()->state(['name' => 'Personal Account']))
                ->has(Location::factory()->state(['city_id' => 345, 'country_id' => 2]))
                ->create([
                    'name' => 'Joeri',
                    'full_name' => 'Joeri Oudshoorn',
                    'email' => 'joeri@test.nl',
                    'profile_photo_path' => 'profile-photos/yhFDKOsyWMr6PkCEd34SK6I3kz2T0YZ3AXMD2PRr.png',
                    'password' => bcrypt('password'),
                    ]);

            $user3 = User::factory()
                ->has(Account::factory()->state(['name' => 'Personal Account']))
                ->has(Location::factory()->state(['city_id' => 330, 'division_id' => 12, 'country_id' => 1]))
                ->create([
                    'name' => 'Sara',
                    'full_name' => 'Sara Pape Garcia',
                    'email' => 'sara@test.nl',
                    'profile_photo_path' => 'profile-photos/UJWh03bKULqtOAvQQh36cJJ4NwjZvTcBWPmL9vzm.png',
                    'password' => bcrypt('password'),
                    ]);


            $org1 = Organization::factory()
                ->has(Account::factory()->state(['name' => 'General Account'])->state(
                    ['name' => 'Currency Creation',
                    'limit_min' => -12000
                    ]
                ))
                ->has(Account::factory()->state(
                    ['name' => 'General']
                ))
                ->has(Location::factory()->state(['city_id' => 305, 'division_id' => 12, 'country_id' => 1]))
                ->create([
                    'name' => 'Timebank.cc Den Haag',
                    'full_name' => 'Timebank.cc Den Haag',
                    'email' => 'tb-den-haag@test.nl',
                    'profile_photo_path' => 'profile-photos/RMawhGXxED1wNNJDEJ7pVbBdg07LGKPAyhGL3npH.png',
                    'password' => bcrypt('password'),
                    ]);

            $org2 = Organization::factory()
                ->has(Account::factory()->state(
                    ['name' => 'Algemeen']
                ))
                ->has(Account::factory()->state(
                    ['name' => 'Gymzaal']
                ))
                ->has(Account::factory()->state(
                    ['name' => 'Wonnebald']
                ))
                ->has(Account::factory()->state(
                    ['name' => 'Spinozahof']
                ))
                ->has(Account::factory()->state(
                    ['name' => 'Mozartlaan']
                ))
                ->has(Location::factory()->state(['city_id' => 305, 'division_id' => 12, 'country_id' => 1]))
                ->create([
                    'name' => 'Lekkernassuh',
                    'email' => 'lekkernassuh@test.nl',
                    'profile_photo_path' => 'profile-photos/hWcYqfdquJW7QiPnyuUtdFsrldykLFZPbR6H4qwF.jpg',
                    'password' => bcrypt('password'),
                    ]);

            DB::table('organization_user')->insert([
                'organization_id' => $org1->id,
                'user_id' => $user1->id]);

            DB::table('organization_user')->insert([
                'organization_id' => $org1->id,
                'user_id' => $user2->id]);

            DB::table('organization_user')->insert([
                'organization_id' => $org2->id,
                'user_id' => $user1->id]);

            DB::table('organization_user')->insert([
                'organization_id' => $org2->id,
                'user_id' => $user2->id]);

            DB::table('organization_user')->insert([
                'organization_id' => $org2->id,
                'user_id' => $user3->id]);

            $this->command->info('The test users and organizations are seeded');
        }
    }
}
