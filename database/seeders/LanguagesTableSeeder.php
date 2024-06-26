<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('languages')->delete();

        \DB::table('languages')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Dutch',
                'lang_code' => 'nl',
                'flag' => '🇳🇱',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'English',
                'lang_code' => 'en',
                'flag' => '🇬🇧',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'French',
                'lang_code' => 'fr',
                'flag' => '🇫🇷',
          ),
            3 =>
            array (
                'id' => 4,
                'name' => 'German',
                'lang_code' => 'de',
                'flag' => '🇩🇪',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Spanish',
                'lang_code' => 'es',
                'flag' => '🇪🇸',
            ),
        ));


    }
}