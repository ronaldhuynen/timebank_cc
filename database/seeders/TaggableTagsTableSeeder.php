<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaggableTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taggable_tags')->delete();
        
        \DB::table('taggable_tags')->insert(array (
            0 => 
            array (
                'tag_id' => 1,
                'name' => 'geel',
                'normalized' => 'geel',
                'created_at' => '2023-08-11 14:42:30',
                'updated_at' => '2023-08-11 14:42:30',
            ),
            1 => 
            array (
                'tag_id' => 2,
                'name' => 'yellow',
                'normalized' => 'yellow',
                'created_at' => '2023-08-11 14:53:56',
                'updated_at' => '2023-08-11 14:53:56',
            ),
            2 => 
            array (
                'tag_id' => 3,
                'name' => 'Gelb',
                'normalized' => 'gelb',
                'created_at' => '2023-08-11 15:12:26',
                'updated_at' => '2023-08-11 15:12:26',
            ),
            3 => 
            array (
                'tag_id' => 4,
                'name' => 'lime',
                'normalized' => 'lime',
                'created_at' => '2023-08-11 15:27:53',
                'updated_at' => '2023-08-11 15:27:53',
            ),
            4 => 
            array (
                'tag_id' => 5,
                'name' => 'green',
                'normalized' => 'green',
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            5 => 
            array (
                'tag_id' => 6,
                'name' => 'groen',
                'normalized' => 'groen',
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            6 => 
            array (
                'tag_id' => 7,
                'name' => 'Grün',
                'normalized' => 'grün',
                'created_at' => '2023-08-11 16:47:31',
                'updated_at' => '2023-08-11 16:47:31',
            ),
            7 => 
            array (
                'tag_id' => 8,
                'name' => 'unexperienced',
                'normalized' => 'unexperienced',
                'created_at' => '2023-08-11 17:08:10',
                'updated_at' => '2023-08-11 17:08:10',
            ),
            8 => 
            array (
                'tag_id' => 9,
                'name' => 'green',
                'normalized' => 'green',
                'created_at' => '2023-08-11 21:07:16',
                'updated_at' => '2023-08-11 21:07:16',
            ),
            9 => 
            array (
                'tag_id' => 10,
                'name' => 'Wood working',
                'normalized' => 'wood working',
                'created_at' => '2023-08-12 00:02:43',
                'updated_at' => '2023-08-12 00:02:43',
            ),
            10 => 
            array (
                'tag_id' => 11,
                'name' => 'houtbewerking',
                'normalized' => 'houtbewerking',
                'created_at' => '2023-08-12 00:13:05',
                'updated_at' => '2023-08-12 00:13:05',
            ),
            11 => 
            array (
                'tag_id' => 13,
                'name' => 'Metal Working',
                'normalized' => 'metal working',
                'created_at' => '2023-08-12 00:37:16',
                'updated_at' => '2023-08-12 00:37:16',
            ),
        ));
        
        
    }
}