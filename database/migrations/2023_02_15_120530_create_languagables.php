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
        Schema::create('languagables', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->integer('competence');
            $table->string('languagable_type');
            $table->unsignedBigInteger('languagable_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languagables');
    }
};
