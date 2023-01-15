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
        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->nullable()->index();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->text('description');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('parent')->default(0)->index();
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
        Schema::dropIfExists('product_category');
    }
};
