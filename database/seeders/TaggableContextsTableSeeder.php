<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaggableContextsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taggable_contexts')->delete();
        
        \DB::table('taggable_contexts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_context_id' => NULL,
                'similar_context_id' => NULL,
                'updated_by_user_id' => 2,
                'created_at' => '2023-08-11 14:43:11',
                'updated_at' => '2023-08-11 14:43:11',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_context_id' => NULL,
                'similar_context_id' => NULL,
                'updated_by_user_id' => 2,
                'created_at' => '2023-08-11 16:48:53',
                'updated_at' => '2023-08-11 16:48:53',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_context_id' => NULL,
                'similar_context_id' => NULL,
                'updated_by_user_id' => 2,
                'created_at' => '2023-08-11 17:33:06',
                'updated_at' => '2023-08-11 17:33:06',
            ),
        ));
        
        
    }
}