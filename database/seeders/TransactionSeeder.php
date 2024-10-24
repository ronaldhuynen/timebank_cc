<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the transaction_types
        DB::table('transaction_types')->insert([
            ['name' => 'work'],
            ['name' => 'gift'],
            ['name' => 'donation'],
            ['name' => 'currency creation'],
            ['name' => 'currency removal']
        ]);

        //$transCount = max((int)$this->command->ask('How many transactions would you like?', 1000), 1);
        //Transaction::factory()->count($transCount)->create();
    }
}
