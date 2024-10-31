<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Product\Models\Admin\Question;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('question_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('question')->onUpdate('cascade')->onDelete('cascade');
            $table->string('value')->nullable();
            $table->unique(['question_id','value']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_items');
    }
};
