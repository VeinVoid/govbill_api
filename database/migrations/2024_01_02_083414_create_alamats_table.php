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
        Schema::create('alamat', function (Blueprint $table) {
            $table->id('id_alamat');
            $table->unsignedBigInteger('id_user');
            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->char('label_alamat', 2);
            $table->text('alamat_lengkap');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamats');
    }
};
