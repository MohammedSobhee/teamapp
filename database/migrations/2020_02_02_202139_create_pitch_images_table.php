<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePitchImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitch_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pitch_id');
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pitch_id')->references('id')->on('pitches')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitch_images');
    }
}
