<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Organisation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgCount = max((int)$this->command->ask('How many organisations would you like?', 10), 1);
        Organisation::factory()->count($orgCount)
            ->has(Account::factory()->count(3)->state(new Sequence(
                ['name' => 'Organisation Account'],
                ['name' => 'Project 1 Account'],
                ['name' => 'Project 2 Account']
            )))
            ->create();
    }
}
