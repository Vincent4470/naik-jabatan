<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Hanya menambahkan kolom, tanpa foreign key
            $table->unsignedBigInteger('id_atasan_langsung')->nullable()->after('id_kecamatan');
        });
    }

    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn('id_atasan_langsung');
        });
    }
};
