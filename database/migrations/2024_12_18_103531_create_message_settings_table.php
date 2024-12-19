<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('message_settings', function (Blueprint $table) {            
            $table->id();
            $table->unsignedBigInteger('message_settingable_id');
            $table->string('message_settingable_type');
            $table->boolean('system_message')->default(true);
            $table->boolean('payment_received')->default(true);
            $table->boolean('local_newsletter')->default(true);
            $table->boolean('general_newsletter')->default(true);
            $table->boolean('personal_chat')->default(true);
            $table->boolean('group_chat')->default(true);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('message_settings');
    }
}
