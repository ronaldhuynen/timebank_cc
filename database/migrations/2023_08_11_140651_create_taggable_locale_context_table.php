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
        Schema::create('taggable_locale_context', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('tag_id'); // Foreign key column
            $table->unsignedBigInteger('context_id'); // Foreign key column

            $table->foreign('tag_id')->references('tag_id')->on('taggable_tags')->onDelete('cascade');     // Many-to-many relation
            $table->foreign('context_id')->references('id')->on('taggable_contexts')->onDelete('cascade'); // Many-to-many relation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taggable_locale_context');
    }
};
