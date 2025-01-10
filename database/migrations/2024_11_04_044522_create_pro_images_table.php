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
      Schema::create('pro_images', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('product_id');
    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    $table->string('image'); 
    $table->unsignedBigInteger('color_id')->nullable();
    $table->foreign('color_id')->references('id')->on('attribute_values')->onDelete('set null');
    $table->timestamps();
    
    // Define foreign key for color if applicable
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pro_images');
    }
};
