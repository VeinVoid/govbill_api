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
        Schema::create('tagihan_terdaftars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('no_tagihan');
            $table->string('jenis_tagihan');
            $table->string('nama_tagihan');
            $table->integer('tanggal_bayar');
            $table->integer('bulan_bayar')->nullable();
            $table->unsignedBigInteger('id_stnk')->nullable();
            $table->unsignedBigInteger('id_alamat')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagihan_terdaftars', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });
        Schema::dropIfExists('tagihan_terdaftars');
    }
};
