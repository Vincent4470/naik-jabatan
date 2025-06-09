<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kota_kabupatens', function (Blueprint $table) {
            $table->foreign('id_provinsi')->references('id_provinsi')->on('provinsis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('kota_kabupatens', function (Blueprint $table) {
            $table->dropForeign(['id_provinsi']);
        });
    }
};
