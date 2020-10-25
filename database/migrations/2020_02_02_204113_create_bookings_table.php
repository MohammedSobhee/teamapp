<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pitch_id');
            $table->unsignedBigInteger('player_id');
            $table->timestamp('date_time');
            $table->integer('hours_no');
            $table->double('cost_hour');

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('pitch_id')->references('id')->on('pitches')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
