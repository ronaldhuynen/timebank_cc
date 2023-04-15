<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('districts')->delete();

        \DB::table('districts')->insert(array (
            0 =>
            array (
                'id' => 1,
                'city_id' => 305,
            ),
            1 =>
            array (
                'id' => 2,
                'city_id' => 305,
            ),
            2 =>
            array (
                'id' => 3,
                'city_id' => 305,
            ),
            3 =>
            array (
                'id' => 4,
                'city_id' => 305,
            ),
            4 =>
            array (
                'id' => 5,
                'city_id' => 305,
            ),
            5 =>
            array (
                'id' => 6,
                'city_id' => 305,
            ),
            6 =>
            array (
                'id' => 7,
                'city_id' => 305,
            ),
            7 =>
            array (
                'id' => 8,
                'city_id' => 305,
            ),
        ));


    }
}