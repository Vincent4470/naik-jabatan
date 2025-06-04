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
        Schema::create('status_pengajuans', function (Blueprint $table) {
            $table->id('id_status');
            $table->string('nama_status'); // contoh: Menunggu, Diverifikasi, Ditolak, Disetujui
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pengajuans');
    }
};
