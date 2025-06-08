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
        Schema::table('pengajuan_kenaikkan', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_kenaikkan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_periode')->nullable()->after('id_pengajuan');

            $table->foreign('id_periode')
                ->references('id_periode')->on('periodes')
                ->onDelete('set null');
        });
    }
};
