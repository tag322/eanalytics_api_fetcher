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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('income_id')->nullable();

            $table->string('number')->default('');

            $table->date('date')->nullable();
            $table->date('last_change_date')->nullable();
            $table->date('date_close')->nullable();
 
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();

            $table->string('barcode')->nullable();

            $table->unsignedInteger('quantity')->nullable();

            $table->decimal('total_price', 12, 2)->nullable();

            $table->string('warehouse_name')->nullable();

            $table->BigInteger('nm_id')->nullable();

            // $table->timestamps();

            // $table->index('last_change_date');
            // $table->index('nm_id');
            // $table->index('barcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
