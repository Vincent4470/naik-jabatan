<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penilaians', function (Blueprint $table) {
            $table->id('id_detail_penilaian');
            $table->unsignedBigInteger('id_penilaian');
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedTinyInteger('nilai');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penilaians');
    }
};
