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
    Schema::table('users', function (Blueprint $table) {
        $table->foreign('id_role')->references('id_role')->on('role_users')->onDelete('cascade');
        $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['id_role']);
        $table->dropForeign(['id_pegawai']);
    });
}

};
