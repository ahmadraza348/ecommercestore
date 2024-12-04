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
     Schema::create('relational_categories', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('attribute_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
    $table->unsignedBigInteger('metaable_id');
    $table->string('metaable_type'); 
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relational_categories');
    }
};
