<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('picture')->nullable();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->enum('status', ['pendente', 'confirmado','cancelado'])->default('pendente')->nullable();
            $table->enum('act', ['youtube', 'link', 'desc'])->nullable();
            $table->string('act_link')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
