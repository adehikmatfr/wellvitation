<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBridesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brides', function (Blueprint $table) {
            $table->id();
            $table->string('bridegroom_name', 100);
            $table->string('bridegroom_religion', 100);
            $table->string('bridegroom_guardian', 100);
            $table->text('bridegroom_bio');
            $table->text('bridegroom_social');
            $table->string('bride_name', 100);
            $table->string('bride_religion', 100);
            $table->string('bride_guardian', 100);
            $table->text('bride_bio');
            $table->text('bride_social');

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
        Schema::dropIfExists('brides');
    }
}
