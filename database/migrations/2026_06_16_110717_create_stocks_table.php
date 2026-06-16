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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->date('date')->nullable();
            $table->date('last_change_date')->nullable('last_change_date');

            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->string('barcode')->nullable();

            $table->unsignedInteger('quantity')->nullable();
            $table->unsignedInteger('quantity_full')->nullable();

            $table->boolean('is_supply')->nullable();
            $table->boolean('is_realization')->nullable();

            $table->string('warehouse_name');

            $table->boolean('in_way_to_client')->nullable();
            $table->boolean('in_way_from_client')->nullable();

            $table->BigInteger('nm_id')->nullable();

            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();

            $table->unsignedBigInteger('sc_code')->nullable();

            $table->decimal('price', 12, 2)->nullable();
            $table->unsignedTinyInteger('discount')->nullable();

            // $table->timestamps();

            // $table->index('last_change_date');
            // $table->index('nm_id');
            // $table->index('barcode');
            // $table->index('sc_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
