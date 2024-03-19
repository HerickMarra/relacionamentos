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
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('status');
            $table->string('title')->nullable()->after('status');
            $table->string('desc')->nullable()->after('status');
            $table->string('subdesc')->nullable()->after('status');
            $table->string('color')->nullable()->after('status');
            $table->string('image')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('title');
            $table->dropColumn('desc');
            $table->dropColumn('color');
            $table->dropColumn('image');
        });
    }
};
