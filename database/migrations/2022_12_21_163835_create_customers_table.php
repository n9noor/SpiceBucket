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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('emailid', 85)->unique()->index();
            $table->string('password')->nullable();
            $table->string('name', 125);
            $table->string('image')->nullable();
            $table->string('phone', 15)->unique()->nullable()->index();
            $table->date('dob')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->string('token_id', 16)->unique()->nullable()->index();
            $table->string('device_id')->unique()->nullable()->index();
            $table->string('firebase_token_id')->unique()->nullable()->index();
            $table->string('device_type')->nullable()->index();
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
        Schema::dropIfExists('customers');
    }
};
