<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO fix default values for related tables that still need to be written
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_account_id');
            $table->unsignedBigInteger('to_account_id');
            $table->unsignedBigInteger('creator_user_id');
            $table->boolean('from_authorised_by_user_id')->default(false);
            $table->timestamp('from_authorisation_time')->nullable();
            $table->boolean('to_authorised_by_user_id')->default(false);
            $table->timestamp('to_authorisation_time')->nullable();
            $table->integer('amount');
            $table->integer('amount-max')->default(12000); //TODO remove default
            $table->dateTime('programmed_time')->nullable();
            $table->string('description');
            $table->string('from_reference')->default('from_reference'); //TODO remove default;
            $table->string('to_reference')->default('to_reference'); //TODO remove default;
            $table->unsignedBigInteger('transaction_type_id')->default(1); //TODO remove default;
            $table->unsignedBigInteger('transaction_status_id')->default(1); //TODO remove default;
            $table->unsignedBigInteger('cancelled_by_user_id')->nullable();
            $table->timestamp('cancelled_time')->nullable();
            $table->unsignedBigInteger('advertisement_id')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
