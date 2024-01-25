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
        Schema::create('history_tagihans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_tagihan_tersedia');
            $table->unsignedBigInteger('id_metode_pembayaran');
            $table->string('no_pembayaran');
            $table->string('jenis_tagihan');
            $table->string('no_tagihan');
            $table->string('nama_tagihan');
            $table->integer('nominal_tagihan');
            $table->date('waktu_bayar');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_tagihans', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });
        Schema::dropIfExists('history_tagihans');
    }
};