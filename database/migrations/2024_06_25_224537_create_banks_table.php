<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email', 191)->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->text('about')->nullable();
            $table->string('about_short', 150)->nullable();
            $table->string('website')->nullable();
            $table->string('phone', 20)->nullable();
            $table->boolean('phone_public')->default(0);
            $table->integer('cyclos_id')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
