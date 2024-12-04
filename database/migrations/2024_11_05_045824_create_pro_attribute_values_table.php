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
        Schema::create('pro_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->nullable();
            $table->foreignId('attribute_id')->constrained('attributes')->onDelete('cascade')->nullable();
            $table->foreignId('attribute_value_id')->constrained('attribute_values')->onDelete('cascade')->nullable();
            // or
            // $table->foreignId('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
            $table->integer('itemcode')->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('price', 8, 2)->default(0.00)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pro_attribute_values');
    }
};
