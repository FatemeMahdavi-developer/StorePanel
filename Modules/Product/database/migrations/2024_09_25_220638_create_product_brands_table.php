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
        Schema::create('product_brands', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('lang')->default('1');
            $table->integer('admin_id')->default('1');
            $table->string('seo_url')->unique();
            $table->string('seo_title')->nullable();
            $table->string('title');
            $table->string('pic')->nullable();
            $table->text('note')->nullable();
            $table->enum('state',['active','disable'])->default('disable');
            $table->enum('state_main',['active','disable'])->default('disable');
            $table->integer('order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_brands');
    }
};
