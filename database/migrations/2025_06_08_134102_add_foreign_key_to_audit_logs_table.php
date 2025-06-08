<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToAuditLogsTable extends Migration
{
    public function up()
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
