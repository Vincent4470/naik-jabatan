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
        Schema::create('pengajuan_status_logs', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_pengajuan');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_user'); // siapa yang mengubah status
            $table->text('catatan')->nullable();   // bisa diisi alasan jika status ditolak
            $table->timestamp('waktu_status');     // waktu perubahan status
            $table->timestamps();

            // $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan_kenaikans')->onDelete('cascade');
            // $table->foreign('id_status')->references('id_status')->on('status_pengajuans')->onDelete('cascade');
            // $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_status_logs');
    }
};
