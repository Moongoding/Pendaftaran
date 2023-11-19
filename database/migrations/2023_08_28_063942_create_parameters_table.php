<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->index('category_parameter_id');
            $table->index('metode_id');
            $table->unsignedBigInteger('category_parameter_id');
            $table->unsignedBigInteger('metode_id');
            $table->decimal('harga', 11, 0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
};
