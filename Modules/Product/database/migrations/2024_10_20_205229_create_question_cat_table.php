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

        Schema::create('productcat_question_cat', function (Blueprint $table) {
            $table->unsignedBigInteger('productcat_id');
            $table->unsignedBigInteger('question_cat_id');
            $table->foreign('productcat_id')->references('id')->on('productcats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_cat_id')->references('id')->on('question_cats')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productcat_question_cat');
        Schema::dropIfExists('question_cats');

    }
};
