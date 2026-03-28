<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id'); // Foreign key
        $table->string('user_name');
        $table->string('user_email');
        $table->text('comment');
        $table->integer('rating')->default(5);
        $table->timestamps();

        // Optional: Delete reviews if the product is deleted
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
