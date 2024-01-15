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
        Schema::create('tagihan_pbbs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pbb');
            $table->string('nop');
            $table->integer('tagihan');
            $table->dateTime('waktu_bisa_bayar');
            $table->dateTime('waktu_tenggat');
            $table->timestamps();

            $table->foreign('id_pbb')->references('id')->on('data_pbbs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagihan_pbbs', function (Blueprint $table) {
            $table->dropForeign(['id_pbb']);
        });
        Schema::dropIfExists('tagihan_pbbs');
    }
};
