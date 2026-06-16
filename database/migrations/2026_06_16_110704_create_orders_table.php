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

            $table->string('g_number')->unique();

            $table->dateTime('date')->nullable();
            $table->date('last_change_date')->nullable();

            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('barcode')->nullable();

            $table->decimal('total_price', 12, 2)->nullable();
            $table->unsignedTinyInteger('discount_percent')->nullable();

            $table->string('warehouse_name')->nullable();
            $table->string('oblast')->nullable();

            $table->unsignedBigInteger('income_id')->nullable();
            // $table->foreign('income_id')
            //     ->references('income_id')
            //     ->on('incomes')
            //     ->onDelete('cascade');
            $table->string('odid')->nullable();

            $table->BigInteger('nm_id')->nullable();

            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();

            $table->boolean('is_cancel')->nullable();
            $table->dateTime('cancel_dt')->nullable();

            // $table->timestamps();

            // $table->index('last_change_date');
            // $table->index('income_id');
            // $table->index('nm_id');
            // $table->index('barcode');
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
