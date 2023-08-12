<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaggableLocalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taggable_locales')->delete();
        
        \DB::table('taggable_locales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'taggable_tag_id' => 1,
                'locale' => 'nl',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 14:42:30',
                'updated_at' => '2023-08-11 14:42:30',
            ),
            1 => 
            array (
                'id' => 2,
                'taggable_tag_id' => 2,
                'locale' => 'en',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 14:53:56',
                'updated_at' => '2023-08-11 14:53:56',
            ),
            2 => 
            array (
                'id' => 3,
                'taggable_tag_id' => 3,
                'locale' => 'de',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 15:12:26',
                'updated_at' => '2023-08-11 15:12:26',
            ),
            3 => 
            array (
                'id' => 4,
                'taggable_tag_id' => 4,
                'locale' => 'en',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 15:27:53',
                'updated_at' => '2023-08-11 15:27:53',
            ),
            4 => 
            array (
                'id' => 5,
                'taggable_tag_id' => 5,
                'locale' => 'en',
                'descr_short' => 'Colour',
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            5 => 
            array (
                'id' => 6,
                'taggable_tag_id' => 6,
                'locale' => 'nl',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            6 => 
            array (
                'id' => 7,
                'taggable_tag_id' => 7,
                'locale' => 'de',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            7 => 
            array (
                'id' => 8,
                'taggable_tag_id' => 8,
                'locale' => 'en',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 17:08:10',
                'updated_at' => '2023-08-11 17:08:10',
            ),
            8 => 
            array (
                'id' => 9,
                'taggable_tag_id' => 9,
                'locale' => 'nl',
                'descr_short' => 'Deel van een golfbaan',
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-11 21:08:10',
                'updated_at' => '2023-08-11 21:08:10',
            ),
            9 => 
            array (
                'id' => 10,
                'taggable_tag_id' => 10,
                'locale' => 'en',
                'descr_short' => 'To make out of wood',
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-12 00:02:43',
                'updated_at' => '2023-08-12 00:02:43',
            ),
            10 => 
            array (
                'id' => 11,
                'taggable_tag_id' => 11,
                'locale' => 'nl',
                'descr_short' => 'Uit hout maken',
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-12 00:13:05',
                'updated_at' => '2023-08-12 00:14:19',
            ),
            11 => 
            array (
                'id' => 13,
                'taggable_tag_id' => 13,
                'locale' => 'en',
                'descr_short' => NULL,
                'descr_long' => NULL,
                'examples' => NULL,
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
        ));
        
        
    }
}