<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->string('title');
            $table->unsignedInteger('quantity')->default(0);
            $table->string('location_zone');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'location_zone']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
