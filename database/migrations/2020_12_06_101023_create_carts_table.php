<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_item');
            $table->string('name_user');
            $table->string('name_item');
            $table->string('address');
            $table->string('phone');
            $table->integer('price');
            $table->integer('qty');
            $table->string('size')->default('L');
            $table->string('payment')->nullable();
            $table->string('status')->default('pending');;
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_item')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
