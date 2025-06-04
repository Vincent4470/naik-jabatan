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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_pegawai')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Foreign key
            // $table->foreign('id_role')->references('id_role')->on('role_users')->onDelete('cascade');
            // $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
