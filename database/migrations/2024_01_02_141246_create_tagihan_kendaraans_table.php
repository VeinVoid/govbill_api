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
        Schema::create('tagihan_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_stnk');
            $table->unsignedBigInteger('id_alamat');
            $table->unsignedBigInteger('id_nik');
            $table->integer('nominal_swdkllj');
            $table->integer('nominal_pkb');
            $table->date('waktu_pembayaran');
            $table->date('waktu_tenggat');
            $table->timestamps();

            $table->foreign('id_stnk')->references('id')->on('data_stnks')->onDelete('cascade');
            $table->foreign('id_alamat')->references('id')->on('alamats')->onDelete('cascade');
            $table->foreign('id_nik')->references('id')->on('data_niks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagihan_kendaraans', function (Blueprint $table) {
            $table->dropForeign(['id_stnk']);
            $table->dropForeign(['id_alamat']);
            $table->dropForeign(['id_nik']);
        });
        Schema::dropIfExists('tagihan_kendaraans');
    }
};
