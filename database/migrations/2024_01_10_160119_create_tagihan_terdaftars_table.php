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
            $table->unsignedBigInteger('id_data_tagihan');
            $table->string('no_tagihan');
            $table->string('jenis_tagihan');
            $table->string('identitas');
            $table->string('alamat');
            $table->string('tanggal_bayar');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_data_tagihan')->references('id')->on('data_tagihans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_terdaftars');
    }
};
