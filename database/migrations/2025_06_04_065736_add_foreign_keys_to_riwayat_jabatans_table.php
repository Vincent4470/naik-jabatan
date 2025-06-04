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
        Schema::table('riwayat_jabatans', function (Blueprint $table) {
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais')->onDelete('cascade');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_jabatans', function (Blueprint $table) {
            $table->dropForeign(['id_pegawai']);
            $table->dropForeign(['id_jabatan']);
        });
    }
};
