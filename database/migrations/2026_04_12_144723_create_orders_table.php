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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('state', ['queue', 'processing', 'ended', 'warning', 'partial-end', 'paused', 'sospended', 'cancelled'])->nullable()->default('string');
            $table->date('date')->nullable();
            $table->double('qty', 15, 8)->nullable();
            $table->double('qty_end', 15, 8)->nullable();
            $table->double('qty_res', 15, 8)->nullable();
            $table->string('batch_code')->nullable();
            $table->string('type_production')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('product_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
