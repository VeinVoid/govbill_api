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
        Schema::create('tagihan_pdam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pdam');
            $table->integer('tagihan');
            $table->date('waktu_pembayaran');
            $table->date('waktu_tenggat');
            $table->timestamps();

            $table->foreign('id_pdam')->references('id')->on('data_pdam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_pdam');
    }
};
