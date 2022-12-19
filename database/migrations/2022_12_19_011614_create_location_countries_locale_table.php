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
        Schema::create('location_countries_locale', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->unsigned();
            $table->string('name', 255)->default('');
            $table->string('alias', 255)->nullable();
            $table->string('abbr', 16)->nullable();
            $table->string('currency_name', 255)->nullable();
            $table->string('locale', 6)->nullable();
            $table->unique(['country_id','locale'], 'uniq_country_id_locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_countries_locale');
    }
};
