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
        Schema::create('riwayat_jabatans', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_jabatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable(); // null jika masih aktif
            $table->timestamps();

            // $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais')->onDelete('cascade');
            // $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_jabatans');
    }
};
