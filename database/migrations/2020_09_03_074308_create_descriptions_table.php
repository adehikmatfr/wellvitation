<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('web_name', 100);
            $table->string('event_name', 100);
            $table->text('event_desc');
            $table->string('akad_place', 100);
            $table->text('akad_address');
            $table->dateTime('akad_date');
            $table->text('marriage_place');
            $table->text('marriage_address');
            $table->dateTime('marriage_date');
            $table->text('description');
            $table->text('message');
            $table->string('youtube_link', 255);
            $table->string('asset_link', 255);

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
        Schema::dropIfExists('descriptions');
    }
}
