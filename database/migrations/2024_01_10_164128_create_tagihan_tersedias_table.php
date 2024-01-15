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
        Schema::create('tagihan_tersedias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_tagihan_terdaftar');
            $table->string('no_tagihan');
            $table->string('jenis_tagihan');
            $table->string('nama_tagihan');
            $table->integer('nominal_bayar');
            $table->date('waktu_bayar');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_tagihan_terdaftar')->references('id')->on('tagihan_terdaftars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagihan_tersedias', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_tagihan_terdaftar']);
        });
        Schema::dropIfExists('tagihan_tersedias');
    }
};
