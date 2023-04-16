<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Organisation;
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
        if ($this->command->confirm('Do you want to seed the test users and organisations?')) {

            $user1 = User::factory()->has(Account::factory()->state(['name' => 'Personal Account']))
                ->create([
                    'name' => 'Ronald',
                    'email' => 'ronald@test.nl',
                    'profile_photo_path' => 'profile-photos/b1noabVz64Wj6yuejFcISJPeWFAb9v7Ju3FsFZn4.png',
                    'password' => bcrypt('password'),
                    ]);

            $user2 = User::factory()->has(Account::factory()->state(['name' => 'Personal Account']))
                ->create([
                    'name' => 'Joeri',
                    'email' => 'joeri@test.nl',
                    'profile_photo_path' => 'profile-photos/lN2E99fso4ULml9wi7cHSsfT1BTAtJYEsTAql2Ly.png',
                    'password' => bcrypt('password'),
                    ]);

            $user3 = User::factory()->has(Account::factory()->state(['name' => 'Personal Account']))
                ->create([
                    'name' => 'Sara',
                    'email' => 'sara@test.nl',
                    'profile_photo_path' => 'profile-photos/UJWh03bKULqtOAvQQh36cJJ4NwjZvTcBWPmL9vzm.png',
                    'password' => bcrypt('password'),
                    ]);

            $org1 = Organisation::factory()
                ->has(Account::factory()->state(['name' => 'General Account'])->state(
                    ['name' => 'Currency Creation',
                    'limit_min' => -12000
                    ]))
                ->has(Account::factory()->state(
                    ['name' => 'General']))
                ->create([
                    'name' => 'Timebank.cc Den Haag',
                    'email' => 'tb-den-haag@test.nl',
                    'profile_photo_path' => 'profile-photos/RMawhGXxED1wNNJDEJ7pVbBdg07LGKPAyhGL3npH.png',
                    ]);

            $org2 = Organisation::factory()
                ->has(Account::factory()->state(
                    ['name' => 'Algemeen']))
                ->has(Account::factory()->state(
                    ['name' => 'Gymzaal']))
                ->has(Account::factory()->state(
                    ['name' => 'Wonnebald']))
                ->has(Account::factory()->state(
                    ['name' => 'Spinozahof']))
                ->has(Account::factory()->state(
                    ['name' => 'Mozartlaan']))
                ->create([
                    'name' => 'Lekkernassuh',
                    'email' => 'lekkernassuh@test.nl',
                    'profile_photo_path' => 'profile-photos/hWcYqfdquJW7QiPnyuUtdFsrldykLFZPbR6H4qwF.jpg',
                    ]);

                DB::table('organisation_user')->insert([
                    'organisation_id' => $org1->id,
                    'user_id' => $user1->id]);

                DB::table('organisation_user')->insert([
                    'organisation_id' => $org1->id,
                    'user_id' => $user2->id]);

                DB::table('organisation_user')->insert([
                    'organisation_id' => $org2->id,
                    'user_id' => $user1->id]);

                DB::table('organisation_user')->insert([
                    'organisation_id' => $org2->id,
                    'user_id' => $user2->id]);

                DB::table('organisation_user')->insert([
                    'organisation_id' => $org2->id,
                    'user_id' => $user3->id]);

            $this->command->info('The test users and organisations are seeded');
        }
    }
}
