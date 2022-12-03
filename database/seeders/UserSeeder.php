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
         // Seed Super-Admin with user id 1
        $admin = User::factory()->create([
            'name' => 'Super-Admin',
            'email' => 'admin@admin.com',
            'locale' => 'en',
            'password' => bcrypt('SecurePassword')  // Super-Admin password: 'SecurePassword'
        ]);

        $admin->assignRole('Super-Admin');

        // Seed other users
        $usersCount = max((int)$this->command->ask('How many users would you like?', 200), 1);
        User::factory()->count($usersCount)
            ->has(Profile::factory())
            ->has(Account::factory()->state(['name' => 'Personal Account']))
            ->create();
    }
}
