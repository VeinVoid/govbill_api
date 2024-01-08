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
        Schema::create('tagihan_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_stnk');
            $table->unsignedBigInteger('id_alamat');
            $table->integer('nominal_swdkllj');
            $table->integer('nominal_pkb');
            $table->date('waktu_pembayaran');
            $table->date('waktu_tenggat');
            $table->timestamps();

            $table->foreign('id_stnk')->references('id_stnk')->on('data_stnk')->onDelete('cascade');
            $table->foreign('id_alamat')->references('id_alamat')->on('alamat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_kendaraans');
    }
};
