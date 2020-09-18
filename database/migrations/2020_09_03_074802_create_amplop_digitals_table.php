<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmplopDigitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amplop_digitals', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id', 100);
            $table->bigInteger('user_id')->unsigned();
            $table->integer('nominal');
            $table->string('payment_method');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amplop_digitals');
    }
}
