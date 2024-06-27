<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Locations\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = max((int)$this->command->ask('How many fake users would you like?', 200), 0);
        $cities = [
            305, // The Hague is used more frequent
            305, // The Hague
            305, // The Hague
            305, // The Hague
            300, // Delft
            330, // Rijswijk
            342, // Zoetermeer
            345, // Brussels is used slightly more frequent
            345, // Brussels
            346, // Antwerp
        ];
        User::factory()->count($usersCount)
            ->has(Account::factory()->state(['name' => 'Personal Account']))
            ->create()
            ->each(
                function ($user) use ($cities) {
                    // Create a location with a random city_id for each user
                    Location::factory()->create([
                        'locatable_type' => User::class,  // This specifies the relation is with User
                        'locatable_id' => $user->id,
                        'city_id' => collect($cities)->random(),
                    ]);

                }
            );
    }
}
