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
        Schema::create('location_divisions_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id')->index();
            $table->foreign('division_id')->references('id')->on('location_divisions')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('alias', 255)->nullable();
            $table->string('locale', 6)->index();
            $table->unique(['division_id','locale'], 'uniq_division_id_locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_divisions_locales');
    }
};
