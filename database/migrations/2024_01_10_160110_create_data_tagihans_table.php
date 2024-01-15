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
        Schema::create('data_tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_tagihan');
            $table->string('no_tagihan')->unique;
            $table->string('identitas');
            $table->string('kota_kabupaten')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_tagihans');
    }
};