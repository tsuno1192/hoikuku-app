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
        Schema::create('anonymous_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // 職員（匿名化して扱う）
            $table->string('status')->default('open'); // open, in_progress, closed
            $table->timestamps();
        });

        Schema::create('anonymous_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anonymous_thread_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // 送信者（職員 or カウンセラー）
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anonymous_chats');
        Schema::dropIfExists('anonymous_messages');
    }
};
