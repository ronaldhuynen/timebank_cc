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
        Schema::create('district_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('district_id')->index();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('alias', 255)->nullable();
            $table->string('locale', 6)->index();
            $table->unique(['district_id','locale'], 'uniq_district_id_locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_locales');
    }
};
