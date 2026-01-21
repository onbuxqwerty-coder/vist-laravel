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
        Schema::create('product_configuration_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('configuration_id')->constrained('product_configurations')->onDelete('cascade');
            $table->string('spec_key', 128);
            $table->text('spec_value');
            $table->integer('sort_order')->default(0);
            
            $table->index(['configuration_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_configuration_specs');
    }
};
