<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageCompetencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('language_competences')->delete();

        \DB::table('language_competences')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'good',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'limited',
            ),
        ));


    }
}