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
        Schema::create('penilaians', function (Blueprint $table) {
        $table->id('id_penilaian');
        $table->unsignedBigInteger('id_pengajuan')->unique(); // one-to-one
        $table->unsignedBigInteger('id_user_admin'); // user yang menilai (admin)
        $table->text('hasil_penilaian'); // isi penilaian/verifikasi
        $table->date('tanggal_penilaian');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
