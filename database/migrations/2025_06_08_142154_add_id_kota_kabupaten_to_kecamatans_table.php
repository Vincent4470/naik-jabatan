<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kecamatans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kota_kabupaten')->after('id_kecamatan');
            $table->foreign('id_kota_kabupaten')
                  ->references('id_kota_kabupaten')
                  ->on('kota_kabupatens')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('kecamatans', function (Blueprint $table) {
            $table->dropForeign(['id_kota_kabupaten']);
            $table->dropColumn('id_kota_kabupaten');
        });
    }
};
