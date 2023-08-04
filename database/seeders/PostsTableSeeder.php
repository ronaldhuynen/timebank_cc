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
            5 => 
            array (
                'id' => 18,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 5,
                'created_at' => '2023-08-04 14:09:47',
                'updated_at' => '2023-08-04 14:09:47',
            ),
            6 => 
            array (
                'id' => 19,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 6,
                'created_at' => '2023-08-04 14:42:31',
                'updated_at' => '2023-08-04 14:42:31',
            ),
            7 => 
            array (
                'id' => 20,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 7,
                'created_at' => '2023-08-04 16:23:26',
                'updated_at' => '2023-08-04 16:23:42',
            ),
            8 => 
            array (
                'id' => 21,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 8,
                'created_at' => '2023-08-04 16:24:25',
                'updated_at' => '2023-08-04 16:24:25',
            ),
        ));
        
        
    }
}