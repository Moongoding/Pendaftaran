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
        Schema::create('analisa_parameter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('analisa_id');
            $table->unsignedBigInteger('parameter_id');
            $table->timestamps();

            $table->foreign('analisa_id')->references('id')->on('analisas')->onDelete('cascade');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisa_parameter');
    }
};
