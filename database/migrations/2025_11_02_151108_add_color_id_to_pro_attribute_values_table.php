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
        Schema::table('pro_attribute_values', function (Blueprint $table) {
            $table->unsignedBigInteger('color_id')->after('attribute_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pro_attribute_values', function (Blueprint $table) {
            $table->dropColumn('color_id');
        });
    }
};
