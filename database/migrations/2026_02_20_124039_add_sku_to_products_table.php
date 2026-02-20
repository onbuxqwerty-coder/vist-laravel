<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku', 32)->nullable()->unique()->after('id');
        });

        // Fill SKU for existing products
        DB::table('products')->orderBy('id')->each(function ($product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update(['sku' => '0000' . $product->id]);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sku');
        });
    }
};
