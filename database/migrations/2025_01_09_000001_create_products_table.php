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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 64)->unique()->nullable();
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->enum('product_type', ['workstation', 'server', 'ipc', 'storage', 'other']);
            $table->enum('status', ['in_stock', 'out_of_stock', 'by_order'])->default('by_order');
            $table->integer('warranty_months')->default(12);
            $table->decimal('price', 12, 2)->nullable();
            $table->timestamps();
            
            $table->index('product_type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
