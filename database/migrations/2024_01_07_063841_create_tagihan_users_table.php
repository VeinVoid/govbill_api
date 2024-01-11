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
        Schema::create('tagihan_user', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->unsignedBigInteger('id_user');
            $table->string('nomor_tagihan');
            $table->string('tipe_tagihan', 2);
            $table->char('status', 1);

            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_user');
    }
};
