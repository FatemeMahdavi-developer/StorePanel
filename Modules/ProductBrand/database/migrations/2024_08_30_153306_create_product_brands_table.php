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

        Schema::create('product_brand_product_cat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_brand_id')->constrained('product_brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_cat_id')->constrained('product_cats')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['product_brand_id','product_cat_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_brand_product_cat');
        Schema::dropIfExists('product_brands');
    }
};
