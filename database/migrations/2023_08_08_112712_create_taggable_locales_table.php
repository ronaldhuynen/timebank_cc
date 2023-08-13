<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggable_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taggable_tag_id'); // Foreign key column
            $table->string('locale', 6);
            $table->string('descr_short', 200)->nullable();
            $table->string('descr_long')->nullable();
            $table->string('example', 300)->nullable();
            $table->timestamps();

            $table->unique(['taggable_tag_id', 'locale']);
            $table->foreign('taggable_tag_id')->references('tag_id')->on('taggable_tags')->onDelete('cascade');

            $table->index('locale');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taggable_locales');
    }
};
