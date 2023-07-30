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
                ->has(Location::factory())
                ->create([
                    'name' => 'Ronald',
                    'email' => 'ronald@test.nl',
                    'profile_photo_path' => 'profile-photos/b1noabVz64Wj6yuejFcISJPeWFAb9v7Ju3FsFZn4.png',
                    'password' => bcrypt('password'),
                    ]);

            DB::table('cityables')->insert([
                    'city_id' => 305,
                    'cityable_type' => Location::class,
                    'cityable_id' => $user1->locations()->first()->id]);

            $user2 = User::factory()
                ->has(Account::factory()->state(['name' => 'Personal Account']))
                ->has(Location::factory())
                ->create([
                    'name' => 'Joeri',
                    'email' => 'joeri@test.nl',
                    'profile_photo_path' => 'profile-photos/yhFDKOsyWMr6PkCEd34SK6I3kz2T0YZ3AXMD2PRr.png',
                    'password' => bcrypt('password'),
                    ]);

            DB::table('cityables')->insert([
                    'city_id' => 345,
                    'cityable_type' => Location::class,
                    'cityable_id' => $user2->locations()->first()->id]);

            $user3 = User::factory()
                ->has(Account::factory()->state(['name' => 'Personal Account']))
                ->has(Location::factory())
                ->create([
                    'name' => 'Sara',
                    'email' => 'sara@test.nl',
                    'profile_photo_path' => 'profile-photos/UJWh03bKULqtOAvQQh36cJJ4NwjZvTcBWPmL9vzm.png',
                    'password' => bcrypt('password'),
                    ]);

            DB::table('cityables')->insert([
                    'city_id' => 305,
                    'cityable_type' => Location::class,
                    'cityable_id' => $user3->locations()->first()->id]);

            $org1 = Organization::factory()
                ->has(Account::factory()->state(['name' => 'General Account'])->state(
                    ['name' => 'Currency Creation',
                    'limit_min' => -12000
                    ]
                ))
                ->has(Account::factory()->state(
                    ['name' => 'General']
                ))
                ->has(Location::factory())
                ->create([
                    'name' => 'Timebank.cc Den Haag',
                    'email' => 'tb-den-haag@test.nl',
                    'profile_photo_path' => 'profile-photos/RMawhGXxED1wNNJDEJ7pVbBdg07LGKPAyhGL3npH.png',
                    ]);
            
            DB::table('cityables')->insert([
                    'city_id' => 305,
                    'cityable_type' => Location::class,
                    'cityable_id' => $org1->locations()->first()->id]);

                    
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
                ->has(Location::factory())
                ->create([
                    'name' => 'Lekkernassuh',
                    'email' => 'lekkernassuh@test.nl',
                    'profile_photo_path' => 'profile-photos/hWcYqfdquJW7QiPnyuUtdFsrldykLFZPbR6H4qwF.jpg',
                    ]);



            DB::table('cityables')->insert([
                    'city_id' => 305,
                    'cityable_type' => Location::class,
                    'cityable_id' => $org2->locations()->first()->id]);


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
