<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentAmplopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_amplops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amplop_id')->unsigned();
            $table->dateTime('transaction_time');
            $table->string('transaction_status');
            $table->string('transaction_id');
            $table->string('status_message');
            $table->string('status_code');
            $table->string('signature_key');
            $table->string('payment_type');
            $table->string('merchant_id');
            $table->string('masked_card');
            $table->string('gross_amount');
            $table->string('fraud_status');
            $table->string('eci');
            $table->string('currency');
            $table->string('channel_response_message');
            $table->string('channel_response_code');
            $table->string('card_type');
            $table->string('bank');

            $table->timestamps();

            $table->foreign('amplop_id')->references('id')->on('amplop_digitals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_amplops');
    }
}
