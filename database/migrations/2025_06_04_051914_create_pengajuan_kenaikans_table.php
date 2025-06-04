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
        Schema::create('pengajuan_kenaikans', function (Blueprint $table) {
        $table->id('id_pengajuan');
        $table->unsignedBigInteger('id_pegawai');
        $table->unsignedBigInteger('id_jabatan_baru');
        $table->date('tanggal_pengajuan');
        $table->unsignedBigInteger('id_status'); // foreign key ke status_pengajuan
        $table->text('catatan')->nullable();
        $table->timestamps();

        // Foreign keys
        // $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais')->onDelete('cascade');
        // $table->foreign('id_jabatan_baru')->references('id_jabatan')->on('jabatans')->onDelete('cascade');
        // $table->foreign('id_status')->references('id_status')->on('status_pengajuans')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kenaikans');
    }
};
