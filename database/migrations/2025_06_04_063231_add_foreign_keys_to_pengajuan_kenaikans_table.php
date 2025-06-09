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
        Schema::table('pengajuan_kenaikans', function (Blueprint $table) {
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais')->onDelete('cascade');
            $table->foreign('id_jabatan_baru')->references('id_jabatan')->on('jabatans')->onDelete('cascade');
            $table->foreign('id_status')->references('id_status')->on('status_pengajuans')->onDelete('cascade');
            $table->foreign('id_periode')->references('id_periode')->on('periodes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kenaikans', function (Blueprint $table) {
            $table->dropForeign(['id_pegawai']);
            $table->dropForeign(['id_jabatan_baru']);
            $table->dropForeign(['id_status']);
            $table->dropForeign(['id_periode']);  // Jangan lupa drop foreign key id_periode juga
        });
    }
};
