<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sale_price');
            $table->integer('previous_price')->nullable();
            $table->integer('purchase_price')->nullable();
            $table->string('barcode');
            $table->integer('stock');
            $table->string('tags')->nullable();
            $table->string('label')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->mediumText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('featured_image');
            $table->string('back_image')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes column
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
