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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('patronymic', 30);
            $table->string('email', 50)->unique();
            $table->string('phone', 11)->unique();
            $table->string('image')->default('employees/default.png');
            $table->date('started_at');
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
        Schema::dropIfExists('employees');
    }
};
