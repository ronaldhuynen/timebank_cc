<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'App\\Models\\FrontPage',
                'categoryable_id' => 12,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'App\\Models\\News',
                'categoryable_id' => 304,
                'categoryable_type' => 'App\\Models\\Locations\\City',
                'created_at' => '2023-06-02 16:15:10',
                'updated_at' => '2023-06-02 16:15:10',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'App\\Modesl\\SystemAnnouncement',
                'categoryable_id' => 12,
                'categoryable_type' => 'App\\Models\\Locations\\Division',
                'created_at' => '2023-06-02 16:20:59',
                'updated_at' => '2023-06-02 16:20:59',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'type' => 'App\\Models\\Meeting',
                'categoryable_id' => 305,
                'categoryable_type' => 'App\\Models\\Locations\\City',
                'created_at' => '2023-07-04 09:00:02',
                'updated_at' => '2023-07-04 09:00:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}