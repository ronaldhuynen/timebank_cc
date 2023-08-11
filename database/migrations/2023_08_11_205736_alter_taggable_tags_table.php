<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taggable_tags', function (Blueprint $table) {
            $table->dropUnique('taggable_tags_normalized_unique');  // Drop original package constraint as multiple languages can use the same words with different context
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::table('taggable_tags', function (Blueprint $table) {
            $table->unique('normalized');  // Restore original package constraint
        });

    }
};
