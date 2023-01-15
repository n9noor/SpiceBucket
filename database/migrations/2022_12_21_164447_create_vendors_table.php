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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('responsible_person');
            $table->string('store_name');
            $table->string('business_emailid')->unique()->index();
            $table->string('password')->nullable();
            $table->string('phone', 15)->unique()->nullable();
            $table->string('gst', 20)->unique();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('token_id', 16)->unique()->nullable()->index();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_approved')->default(false)->index();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('vendors');
    }
};
