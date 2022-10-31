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
        // Seed test transaction_types
        DB::table('transaction_types')->insert([
            ['name' => 'Work'],
            ['name' => 'Gift'],
            ['name' => 'Donation'],
            ['name' => 'Currency creation'],
            ['name' => 'Currency removal']
        ]);

        $transCount = max((int)$this->command->ask('How many transactions would you like?', 1000), 1);
        Transaction::factory()->count($transCount)->create();
    }
}
