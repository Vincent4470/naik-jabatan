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
        Schema::table('detail_penilaians', function (Blueprint $table) {
            // Membuat relasi ke tabel 'penilaians'
            // Jika sebuah data penilaian dihapus, semua detailnya akan ikut terhapus (cascade)
            $table->foreign('id_penilaian')
                  ->references('id_penilaian')
                  ->on('penilaians')
                  ->onDelete('cascade');

            // Membuat relasi ke tabel 'kriteria_penilaians'
            // Jika sebuah kriteria dihapus, detail penilaian terkait akan ikut terhapus
            $table->foreign('id_kriteria')
                  ->references('id_kriteria')
                  ->on('kriteria_penilaians')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_penilaians', function (Blueprint $table) {
            // Menghapus relasi dalam urutan terbalik
            $table->dropForeign(['id_penilaian']);
            $table->dropForeign(['id_kriteria']);
        });
    }
};
