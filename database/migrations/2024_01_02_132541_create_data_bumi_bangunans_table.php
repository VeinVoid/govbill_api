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
        Schema::create('data_pbb', function (Blueprint $table) {
            $table->id('id_pbb');
            $table->string('nop');
            $table->string('nama_pemilik');
            $table->string('provinsi');
            $table->string('kota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bumi_bangunans');
    }
};
