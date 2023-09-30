<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwapsTable extends Migration
{
    public function up()
    {
        Schema::create('swaps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_users_id');
            $table->unsignedBigInteger('from_product_id');
            $table->unsignedBigInteger('to_users_id');
            $table->unsignedBigInteger('to_product_id');
            $table->timestamps();

           
            $table->foreign('from_users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('to_users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_product_id')->references('id')->on('products')->onDelete('cascade');

           
        });
    }

    public function down()
    {
        Schema::dropIfExists('swaps');
    }
}
