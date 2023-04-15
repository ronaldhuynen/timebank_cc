<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictLocalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('district_locales')->delete();

        \DB::table('district_locales')->insert(array (
            0 =>
            array (
                'id' => 1,
                'district_id' => 1,
                'name' => 'Centrum',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            1 =>
            array (
                'id' => 2,
                'district_id' => 2,
                'name' => 'Laak',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            2 =>
            array (
                'id' => 3,
                'district_id' => 3,
                'name' => 'Leidschenveen-Ypenburg ',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            3 =>
            array (
                'id' => 4,
                'district_id' => 4,
                'name' => 'Escamp',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            4 =>
            array (
                'id' => 5,
                'district_id' => 5,
                'name' => 'Loosduinen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            5 =>
            array (
                'id' => 6,
                'district_id' => 6,
                'name' => 'Segbroek',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            6 =>
            array (
                'id' => 7,
                'district_id' => 7,
                'name' => 'Scheveningen',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            7 =>
            array (
                'id' => 8,
                'district_id' => 8,
                'name' => 'Haagse Hout',
                'alias' => NULL,
                'locale' => 'nl',
            ),
            8 =>
            array (
                'id' => 9,
                'district_id' => 1,
                'name' => 'Centrum',
                'alias' => NULL,
                'locale' => 'en',
            ),
            9 =>
            array (
                'id' => 10,
                'district_id' => 2,
                'name' => 'Laak',
                'alias' => NULL,
                'locale' => 'en',
            ),
            10 =>
            array (
                'id' => 11,
                'district_id' => 3,
                'name' => 'Leidschenveen-Ypenburg ',
                'alias' => NULL,
                'locale' => 'en',
            ),
            11 =>
            array (
                'id' => 12,
                'district_id' => 4,
                'name' => 'Escamp',
                'alias' => NULL,
                'locale' => 'en',
            ),
            12 =>
            array (
                'id' => 13,
                'district_id' => 5,
                'name' => 'Loosduinen',
                'alias' => NULL,
                'locale' => 'en',
            ),
            13 =>
            array (
                'id' => 14,
                'district_id' => 6,
                'name' => 'Segbroek',
                'alias' => NULL,
                'locale' => 'en',
            ),
            14 =>
            array (
                'id' => 15,
                'district_id' => 7,
                'name' => 'Scheveningen',
                'alias' => NULL,
                'locale' => 'en',
            ),
            15 =>
            array (
                'id' => 16,
                'district_id' => 8,
                'name' => 'Haagse Hout',
                'alias' => NULL,
                'locale' => 'en',
            ),
        ));


    }
}