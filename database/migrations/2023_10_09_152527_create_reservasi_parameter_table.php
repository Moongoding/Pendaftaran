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
        Schema::create('reservasi_parameter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservations_id');
            $table->unsignedBigInteger('parameter_id');
            $table->integer('jumlah')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('reservations_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi_parameter');
    }
};
