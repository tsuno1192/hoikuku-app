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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 氏名
            $table->date('birth_date'); // 生年月日
            $table->string('diagnosis')->nullable(); // 診断名
            $table->text('sensory_tendencies')->nullable(); // 感覚過敏の傾向
            $table->text('panic_response_steps')->nullable(); // パニック時の対応手順などの配慮事項
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
