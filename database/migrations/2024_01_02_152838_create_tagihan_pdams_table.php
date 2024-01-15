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
        Schema::create('tagihan_pdams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pdam');
            $table->string('no_pelanggan');
            $table->integer('tagihan');
            $table->dateTime('waktu_bisa_bayar');
            $table->dateTime('waktu_tenggat');
            $table->timestamps();

            $table->foreign('id_pdam')->references('id')->on('data_pdams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagihan_pdams', function (Blueprint $table) {
            $table->dropForeign(['id_pdam']);
        });
        Schema::dropIfExists('tagihan_pdams');
    }
};
