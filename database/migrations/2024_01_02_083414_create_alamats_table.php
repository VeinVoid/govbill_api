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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->char('label_alamat');
            $table->text('alamat_lengkap');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alamats', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });
        Schema::dropIfExists('alamats');
    }
};
