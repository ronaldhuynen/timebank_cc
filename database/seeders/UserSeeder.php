<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Locations\Location;
use App\Models\Locations\City;
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
        $usersCount = max((int)$this->command->ask('How many users would you like?', 200), 1);
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
            ->has(Location::factory())
            ->has(Account::factory()->state(['name' => 'Personal Account']))
            ->create()
            ->each(function ($user) use ($cities) {
            DB::table('cityables')->insert([
                    'city_id' => collect($cities)->random(),
                    'cityable_type' => Location::class,
                    'cityable_id' => $user->locations()->first()->id]);
            }
        );
    }
}
