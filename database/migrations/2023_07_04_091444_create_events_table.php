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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); // one-to-one relationship
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->string('address'); // TODO: refactor into location model in later stage            
            $table->integer('meetingable_id'); // Make organizer polymorph: user / organisation / other
            $table->string('meetingable_type'); // Make organizer polymorph: user / organisation / other
            $table->integer('status')->unsigned()->default(1);
            $table->dateTime('from')->nullable();
            $table->dateTime('till')->nullable();
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
        Schema::dropIfExists('meetings');
    }
};
