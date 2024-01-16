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
        Schema::create('data_kartus', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu');
            $table->string('jenis_kartu');
            $table->string('bulan_berlaku');
            $table->string('tahun_berlaku');
            $table->string('cvv');
            $table->string('nama_pemilik');
            $table->integer('saldo');
            $table->boolean('pembayaran_utama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kartus');
    }
};
