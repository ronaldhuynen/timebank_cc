<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

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
        User::factory()->count($usersCount)
            // ->has(Profile::factory())
            ->has(Account::factory()->state(['name' => 'Personal Account']))
            ->create();
    }
}
