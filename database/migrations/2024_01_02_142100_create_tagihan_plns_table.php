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
        Schema::create('tagihan_plns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pln');
            $table->integer('tagihan');
            $table->date('waktu_pembayaran');
            $table->date('waktu_tenggat');
            $table->timestamps();

            $table->foreign('id_pln')->references('id')->on('data_plns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagihan_plns', function (Blueprint $table) {
            $table->dropForeign(['id_pln']);
        });
        Schema::dropIfExists('tagihan_plns');
    }
};
