<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('sub_category_id');
            $table->integer('checkout_id');
            $table->integer('pieces');
            $table->tinyInteger('status')->comment('0: wait, 1: checked out');
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
        Schema::drop('product_carts');
    }
}
