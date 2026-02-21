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
        Schema::table('conversations', function (Blueprint $table) {
            // 既存カラムをnullable化（application_request経由のチャットではnull）
            $table->foreignId('request_application_id')->nullable()->change();
            $table->foreignId('request_id')->nullable()->change();

            // application_request経由のチャット用
            $table->foreignId('application_request_id')
                ->nullable()
                ->after('request_id')
                ->constrained('application_requests')
                ->cascadeOnDelete();

            $table->unique('application_request_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['application_request_id']);
            $table->dropUnique(['application_request_id']);
            $table->dropColumn('application_request_id');

            $table->foreignId('request_application_id')->nullable(false)->change();
            $table->foreignId('request_id')->nullable(false)->change();
        });
    }
};
