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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('type');     // For easier identification of this category
            $table->integer('categoryable_id')->nullable(); // Link the category type to another model: city / organization / other (polymorph)
            $table->string('categoryable_type')->nullable(); // Link the category type to another model: city / organization / other (polymorph)
            $table->unsignedBigInteger('parent_id')->nullable(); // Create nested multilevel categories: id of parent category
            $table->string('color')->nullable()->comment('css class');
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
        Schema::dropIfExists('categories');
    }
};
