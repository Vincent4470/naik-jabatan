<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onDelete('set null');
            $table->foreign('id_provinsi')->references('id_provinsi')->on('provinsis')->onDelete('set null');
            $table->foreign('id_kota_kabupaten')->references('id_kota_kabupaten')->on('kota_kabupatens')->onDelete('set null');
            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatans')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropForeign(['id_jabatan']);
            $table->dropForeign(['id_provinsi']);
            $table->dropForeign(['id_kota_kabupaten']);
            $table->dropForeign(['id_kecamatan']);
        });
    }
};
