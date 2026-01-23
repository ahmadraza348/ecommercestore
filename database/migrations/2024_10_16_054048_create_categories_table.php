<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('is_featured')->default(false); // 0 = not featured
            $table->boolean('status')->default(true); // 1 = active
            $table->timestamps();
        
            // Foreign key for parent category
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null');
        });
        
    }
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
