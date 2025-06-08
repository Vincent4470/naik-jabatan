<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kota_kabupatens', function (Blueprint $table) {
            $table->unsignedBigInteger('id_provinsi')->after('id_kota_kabupaten');
            $table->foreign('id_provinsi')->references('id_provinsi')->on('provinsis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('kota_kabupatens', function (Blueprint $table) {
            $table->dropForeign(['id_provinsi']);
            $table->dropColumn('id_provinsi');
        });
    }
};
