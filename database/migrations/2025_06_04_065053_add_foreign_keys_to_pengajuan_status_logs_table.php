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
        Schema::table('pengajuan_status_logs', function (Blueprint $table) {
            $table->foreign('id_pengajuan')
                ->references('id_pengajuan')
                ->on('pengajuan_kenaikans')
                ->onDelete('cascade');

            $table->foreign('id_status')
                ->references('id_status')
                ->on('status_pengajuans')
                ->onDelete('cascade');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_status_logs', function (Blueprint $table) {
            $table->dropForeign(['id_pengajuan']);
            $table->dropForeign(['id_status']);
            $table->dropForeign(['id_user']);
        });
    }
};
