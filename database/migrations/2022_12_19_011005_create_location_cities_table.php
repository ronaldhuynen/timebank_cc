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
        Schema::create('location_cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->index();
            $table->foreign('country_id')->references('id')->on('location_countries')->onDelete('cascade');
            $table->unsignedBigInteger('division_id')->nullable()->index();
            $table->foreign('division_id')->references('id')->on('location_divisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_cities');
    }
};
