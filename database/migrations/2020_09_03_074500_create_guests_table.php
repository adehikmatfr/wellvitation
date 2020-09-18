<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->integer('invitation_code');
            $table->bigInteger('order_id')->unsigned();
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
            $table->text('address');
            $table->integer('total_guest');
            $table->string('email', 50);
            $table->string('phone', 13);
            $table->tinyInteger('status');
            $table->enum('type', ['Reguler', 'VIP', 'VVIP'])->default('Reguler');
            $table->tinyInteger('is_online');
            $table->text('greetings');
            $table->string('kecamatan', 50);
            $table->string('kota', 50);

            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
