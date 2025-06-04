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
        Schema::create('pegawais', function (Blueprint $table) {
        $table->id('id_pegawai');
        $table->string('nama');
        $table->date('tanggal_lahir');
        $table->string('email')->unique();
        $table->string('unit_kerja');
        $table->unsignedBigInteger('id_jabatan')->nullable(); // jabatan sekarang
        $table->unsignedBigInteger('id_provinsi')->nullable();
        $table->unsignedBigInteger('id_kota_kabupaten')->nullable();
        $table->unsignedBigInteger('id_kecamatan')->nullable();
        $table->date('tanggal_mulai')->nullable();
        $table->timestamps();

        // Foreign key
        // $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onDelete('set null');
        // $table->foreign('id_provinsi')->references('id_provinsi')->on('provinsis')->onDelete('set null');
        // $table->foreign('id_kota_kabupaten')->references('id_kota_kabupaten')->on('kota_kabupatens')->onDelete('set null');
        // $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatans')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
