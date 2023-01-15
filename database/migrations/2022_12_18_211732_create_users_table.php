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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('emailid', 65)->unique()->index();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('firstname', 85);
            $table->string('lastname', 35)->nullable();
            $table->string('phone', 15)->unique()->nullable()->index();
            $table->text('property')->nullable();
            $table->text('design_property')->nullable();
            $table->integer('parent')->default(0)->index();
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
        Schema::dropIfExists('users');
    }
};
