<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variant_price', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('variant_value_id_1')->index();
            $table->foreign('variant_value_id_1')->references('id')->on('product_variant_values');
            $table->unsignedBigInteger('variant_value_id_2')->nullable()->index();
            $table->foreign('variant_value_id_2')->references('id')->on('product_variant_values');
            $table->unsignedBigInteger('variant_value_id_3')->nullable()->index();
            $table->foreign('variant_value_id_3')->references('id')->on('product_variant_values');
            $table->decimal('product_mrp', 10, 2, true);
            $table->decimal('discount_price', 10, 2, true);
            $table->decimal('net_price', 10, 2, true);
            $table->decimal('b2b_price', 10, 2, true);
            $table->string('sku', 20)->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('net_weight', 10, 3, true);
            $table->unsignedInteger('quantity');
            $table->integer('created_by')->nullable()->index();
            $table->integer('updated_by')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variant_price');
    }
};
