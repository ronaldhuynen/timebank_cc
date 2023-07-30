<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Seed test Accounts
        // DB::table('accounts')->insert([
        //     ['name' => 'Personal Account', 'limit_min' => 0, 'limit_max' => 200, 'accountable_type' => 'App\Models\User' , 'accountable_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Personal Account', 'limit_min' => 0, 'limit_max' => 200, 'accountable_type' => 'App\Models\User', 'accountable_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Personal Account', 'limit_min' => 0, 'limit_max' => 200, 'accountable_type' => 'App\Models\User', 'accountable_id' => 201, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Organization Account', 'limit_min' => 0, 'limit_max' => 500, 'accountable_type' => 'App\Models\Organization', 'accountable_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Organization Account', 'limit_min' => 0, 'limit_max' => 500, 'accountable_type' => 'App\Models\Organization', 'accountable_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Local bank Account', 'limit_min' => 0, 'limit_max' => 200, 'accountable_type' => 'App\Models\Organization' , 'accountable_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Super bank Account', 'limit_min' => 0, 'limit_max' => 200, 'accountable_type' => 'App\Models\Organization' , 'accountable_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        // ]);

    }
}
