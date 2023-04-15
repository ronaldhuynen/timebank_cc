<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountryLanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('country_languages')->delete();

        \DB::table('country_languages')->insert(array (
            0 =>
            array (
                'id' =>1,
                'country_id' => 1,
                'code' => 'nl',
            ),
            1 =>
            array (
                'id' => 4,
                'country_id' => 2,
                'code' => 'de',
            ),
            2 =>
            array (
                'id' => 3,
                'country_id' => 2,
                'code' => 'fr',
            ),
            3 =>
            array (
                'id' => 2,
                'country_id' => 2,
                'code' => 'nl',
            ),
        ));


    }
}