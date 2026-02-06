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
            $table->id()->unsigned();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->enum('category', ['workstation', 'server', 'ipc', 'ups'])->default('workstation');
            $table->decimal('price', 12, 2)->default(0);
            $table->char('currency', 3)->default('UAH');
            $table->boolean('is_active')->default(true);
            $table->string('status', 50)->default('in_stock');
            $table->timestamps();
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
