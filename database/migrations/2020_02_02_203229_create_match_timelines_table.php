<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_timelines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('track_type', ['goal', 'yellow_card', 'red_card', 'penalty_kick', 'penalty_lose', 'substitution']);
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('match_id');
            $table->time('track_time');
            $table->unsignedBigInteger('substituted_player_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('substituted_player_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_timelines');
    }
}
