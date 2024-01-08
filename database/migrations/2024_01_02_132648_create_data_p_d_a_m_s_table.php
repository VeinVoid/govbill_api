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
        Schema::create('data_pdam', function (Blueprint $table) {
            $table->id('id_pdam');
            $table->string('no_pelanggan');
            $table->string('nama_pelanggan');
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
        Schema::dropIfExists('data_p_d_a_m_s');
    }
};
