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
        Schema::create('product_cats', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('lang')->default('1');
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onUpdate('cascade')->onDelete('set null');
            $table->string('seo_url')->unique();
            $table->string('seo_title')->nullable();
            $table->string('title');
            $table->string('pic')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('product_cats')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('product_cats');
    }
};
