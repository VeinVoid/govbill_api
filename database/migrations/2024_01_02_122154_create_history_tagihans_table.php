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
        Schema::create('history_tagihan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('id_user');
            $table->string('no_pembayaran');
            $table->string('nama_tagihan');
            $table->integer('harga');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_tagihans');
    }
};
