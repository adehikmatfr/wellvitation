<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 255)->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('bride_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('voucher_id')->unsigned();
            $table->bigInteger('desc_id')->unsigned();
            $table->integer('price_total');
            $table->string('payment_method');
            $table->tinyInteger('payment_status');
            $table->tinyInteger('status_order');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bride_id')->references('id')->on('brides');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->foreign('desc_id')->references('id')->on('descriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
