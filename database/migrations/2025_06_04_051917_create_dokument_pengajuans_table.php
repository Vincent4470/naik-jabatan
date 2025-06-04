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
        Schema::create('dokumen_pengajuans', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->unsignedBigInteger('id_pengajuan');
            $table->string('nama_dokumen'); // nama seperti "SK Jabatan"
            $table->string('file_path'); // lokasi file di storage/public
            $table->timestamps();

            // $table->foreign('id_pengajuan')->references('id_pengajuan')->on('pengajuan_kenaikans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokument_pengajuans');
    }
};
