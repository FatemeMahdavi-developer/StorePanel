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
        Schema::create('product_brand_productcat', function (Blueprint $table) {
            $table->unsignedBigInteger('productcat_id');
            $table->unsignedBigInteger('product_brand_id');
            $table->foreign('productcat_id')->references('id')->on('productcats')->onDelete('cascade');
            $table->foreign('product_brand_id')->references('id')->on('product_brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_brand_productcat');
    }
};
