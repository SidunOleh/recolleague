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
        Schema::create('chat_requests', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->text('request_text');
            $table->text('styles');
            $table->unsignedDecimal('temperature', 2, 1);
            $table->unsignedInteger('max_tokens');
            $table->decimal('presence_penalty', 2, 1);
            $table->decimal('frequency_penalty', 2, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_requests');
    }
};
