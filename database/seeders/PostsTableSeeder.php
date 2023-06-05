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
                'id' => 1,
                'postable_id' => 2,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 2,
                'created_at' => '2023-06-01 12:48:05',
                'updated_at' => '2023-06-01 12:48:05',
            ),
            1 => 
            array (
                'id' => 2,
                'postable_id' => 3,
                'postable_type' => 'App\\Models\\User',
                'category_id' => 3,
                'created_at' => '2023-06-01 12:49:05',
                'updated_at' => '2023-06-01 12:49:05',
            ),
            2 => 
            array (
                'id' => 3,
                'postable_id' => 1,
                'postable_type' => 'App\\Models\\Organisation',
                'category_id' => 2,
                'created_at' => '2023-06-01 12:50:13',
                'updated_at' => '2023-06-01 12:50:13',
            ),
        ));
        
        
    }
}