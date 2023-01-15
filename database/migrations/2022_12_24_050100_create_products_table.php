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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->index();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('product_category');
            $table->boolean('product_type')->default(false)->index();
            $table->string('name');
            $table->string('summary');
            $table->text('description');
            $table->string('hsn_code', 25);
            $table->string('sku', 20);
            $table->string('barcode', 20);
            $table->string('origin')->nullable();
            $table->unsignedInteger('moq');
            $table->decimal('cost', 10, 2, true);
            $table->unsignedInteger('b2b_moq');
            $table->decimal('b2b_price', 10, 2, true);
            $table->decimal('product_mrp', 10, 2, true);
            $table->decimal('discount_price', 10, 2, true);
            $table->decimal('net_price', 10, 2, true);
            $table->boolean('taxable')->default(false);
            $table->unsignedInteger('tax_rate');
            $table->decimal('tax_amount', 10, 2, true)->nullable();
            $table->decimal('net_price_with_tax', 10, 2, true)->nullable();
            $table->text('video_url')->nullable();
            $table->boolean('is_active')->default(true)->index();
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
        Schema::dropIfExists('products');
    }
};
