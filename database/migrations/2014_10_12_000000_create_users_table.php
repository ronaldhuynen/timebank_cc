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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('locale', 3)->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->unsignedBigInteger('city_id_1')->unsigned();
            $table->unsignedBigInteger('district_id_1')->unsigned()->nullable();
            $table->unsignedBigInteger('city_id_2')->unsigned()->nullable();
            $table->unsignedBigInteger('district_id_2')->unsigned()->nullable();

            $table->text('about')->nullable();
            $table->text('motivation')->nullable();
            $table->date('date_of_birth')->nullable();
            $tabel->string('phone', 20)->nullable();
            $table->string('website')->nullable();

            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
