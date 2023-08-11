<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaggableLocaleContextTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taggable_locale_context')->delete();
        
        \DB::table('taggable_locale_context')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tag_id' => 1,
                'context_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'tag_id' => 2,
                'context_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'tag_id' => 3,
                'context_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'tag_id' => 5,
                'context_id' => 2,
            ),
            4 => 
            array (
                'id' => 5,
                'tag_id' => 6,
                'context_id' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'tag_id' => 7,
                'context_id' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'tag_id' => 8,
                'context_id' => 2,
            ),
            7 => 
            array (
                'id' => 8,
                'tag_id' => 8,
                'context_id' => 2,
            ),
        ));
        
        
    }
}