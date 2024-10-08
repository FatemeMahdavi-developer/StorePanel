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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            makeDefaultColumn($table);
            $table->string('seo_url')->unique();
            $table->string('seo_title')->nullable();
            $table->string('title');
            $table->string('pic')->nullable();
            $table->text('note')->nullable();
            $table->foreignId("cat_id")->references("id")->on('productcats')->onDelete("cascade");
            $table->foreignId("brand_id")->references("id")->on('product_brands')->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
