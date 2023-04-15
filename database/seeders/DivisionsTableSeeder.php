<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('divisions')->delete();

        \DB::table('divisions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'country_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'country_id' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'country_id' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'country_id' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'country_id' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'country_id' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'country_id' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'country_id' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'country_id' => 1,
            ),
            9 =>
            array (
                'id' => 10,
                'country_id' => 1,
            ),
            10 =>
            array (
                'id' => 11,
                'country_id' => 1,
            ),
            11 =>
            array (
                'id' => 12,
                'country_id' => 1,
            ),
            12 =>
            array (
                'id' => 13,
                'country_id' => 2,
            ),
            13 =>
            array (
                'id' => 14,
                'country_id' => 2,
            ),
            14 =>
            array (
                'id' => 15,
                'country_id' => 2,
            ),
            15 =>
            array (
                'id' => 16,
                'country_id' => 2,
            ),
            16 =>
            array (
                'id' => 17,
                'country_id' => 2,
            ),
            17 =>
            array (
                'id' => 18,
                'country_id' => 2,
            ),
            18 =>
            array (
                'id' => 19,
                'country_id' => 2,
            ),
            19 =>
            array (
                'id' => 20,
                'country_id' => 2,
            ),
            20 =>
            array (
                'id' => 21,
                'country_id' => 2,
            ),
            21 =>
            array (
                'id' => 22,
                'country_id' => 2,
            ),
            22 =>
            array (
                'id' => 23,
                'country_id' => 2,
            ),
        ));


    }
}