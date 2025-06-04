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

        // $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan_kenaikans')->onDelete('cascade');
        // $table->foreign('id_user_admin')->references('id_user')->on('users')->onDelete('cascade');
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
