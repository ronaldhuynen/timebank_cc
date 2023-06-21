<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSociablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sociables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('social_id');
            $table->string('sociable_type');
            $table->unsignedBigInteger('sociable_id');
            $table->string('user_on_social');
            $table->string('server_of_social')->nullable();
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
        Schema::dropIfExists('sociables');
    }
}
