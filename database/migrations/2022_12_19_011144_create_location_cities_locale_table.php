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
        Schema::create('location_cities_locale', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_id')->unsigned();
            $table->string('name', 255)->default('')->comment('Localized city name');
            $table->string('alias', 255)->nullable()->comment('Localized city alias');
            $table->string('full_name', 255)->nullable()->comment('Localized city fullname');
            $table->string('locale', 6)->nullable()->comment('locale name');
            $table->unique(['city_id','locale'], 'uniq_city_id_locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_cities_locale');
    }
};
