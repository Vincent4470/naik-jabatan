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
        Schema::create('persetujuans', function (Blueprint $table) {
            $table->id('id_persetujuan');
            $table->unsignedBigInteger('id_pengajuan')->unique(); // one-to-one
            $table->unsignedBigInteger('id_user_atasan'); // user yang menyetujui atau menolak
            $table->enum('keputusan', ['disetujui', 'ditolak']);
            $table->text('catatan')->nullable(); // alasan atau pesan
            $table->date('tanggal_persetujuan');
            $table->timestamps();

            // $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan_kenaikans')->onDelete('cascade');
            // $table->foreign('id_user_atasan')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persetujuans');
    }
};
