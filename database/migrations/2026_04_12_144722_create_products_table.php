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
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('unit', 2)->nullable();
            $table->string('unit1',2)->nullable();
            $table->string('unit2', 2)->nullable();
            $table->string('unit3', 2)->nullable();
            $table->double('fatt1', 15, 8)->nullable();
            $table->double('fatt2', 15, 8)->nullable();
            $table->double('fatt3', 15, 8)->nullable();
            $table->foreignId('product_range_id')->nullable()->constrained();
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
