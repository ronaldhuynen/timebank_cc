<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgCount = max((int)$this->command->ask('How many fake organizations would you like?', 10), 0);
        Organization::factory()->count($orgCount)
            ->has(Account::factory()->count(3)->state(new Sequence(
                ['name' => 'Organization Account'],
                ['name' => 'Project 1 Account'],
                ['name' => 'Project 2 Account']
            )))
            ->create();
    }
}
