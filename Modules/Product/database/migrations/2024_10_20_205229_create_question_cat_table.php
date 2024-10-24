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
        Schema::create('question_cats', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('question_cats_productcats', function (Blueprint $table) {
            $table->unsignedBigInteger('productcats_id');
            $table->unsignedBigInteger('question_cats_id');
            $table->foreign('productcats_id')->references('id')->on('productcats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_cats_id')->references('id')->on('question_cats')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_cats');

        Schema::dropIfExists('question_cats_productcats');
    }
};
