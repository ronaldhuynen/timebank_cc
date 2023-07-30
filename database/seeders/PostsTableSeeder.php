<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 13,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 4,
                'created_at' => '2023-07-29 21:44:43',
                'updated_at' => '2023-07-29 21:44:43',
            ),
            1 => 
            array (
                'id' => 14,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 4,
                'created_at' => '2023-07-29 21:49:40',
                'updated_at' => '2023-07-29 21:49:40',
            ),
            2 => 
            array (
                'id' => 15,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 4,
                'created_at' => '2023-07-29 22:30:08',
                'updated_at' => '2023-07-29 22:30:08',
            ),
            3 => 
            array (
                'id' => 16,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 2,
                'created_at' => '2023-07-29 23:00:21',
                'updated_at' => '2023-07-29 23:00:21',
            ),
            4 => 
            array (
                'id' => 17,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 2,
                'created_at' => '2023-07-29 23:00:53',
                'updated_at' => '2023-07-29 23:00:53',
            ),
        ));
        
        
    }
}