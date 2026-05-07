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
        Schema::create('culinary_items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('category', 50)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('restaurant_name', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culinary_items');
    }
};
