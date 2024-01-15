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
        Schema::create('tagihan_bpjs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bpjs');
            $table->string('no_va');
            $table->integer('tagihan');
            $table->date('waktu_bisa_bayar');
            $table->date('waktu_tenggat');
            $table->timestamps();

            $table->foreign('id_bpjs')->references('id')->on('data_bpjs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tagihan_bpjs', function (Blueprint $table) {
            $table->dropForeign(['id_bpjs']);
        });
        Schema::dropIfExists('tagihan_bpjs');
    }
};
