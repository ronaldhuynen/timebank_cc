
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cyclos_skills', function (Blueprint $table) {
            $table->id();
            $table->integer('field_id');
            $table->string('string_value', 300);
            $table->integer('member_id');
            $table->string('lang',2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyclos_skills');
    }
};
