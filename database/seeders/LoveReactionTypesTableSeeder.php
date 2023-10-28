<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoveReactionTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('love_reaction_types')->delete();
        
        \DB::table('love_reaction_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'star',
                'mass' => 1,
                'created_at' => '2023-08-05 03:51:05',
                'updated_at' => '2023-06-13 22:42:51',
            ),
        ));
        
        
    }
}