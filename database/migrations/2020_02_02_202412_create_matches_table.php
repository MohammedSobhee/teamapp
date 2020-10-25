<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('type', ['random', 'league', 'challenge', 'normal']);
            $table->unsignedBigInteger('team_one_id');
            $table->unsignedBigInteger('team_two_id');
            $table->timestamp('match_date_time');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('league_id')->nullable();
            $table->unsignedBigInteger('pitch_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->enum('status', ['new', 'current', 'finished'])->default('new');
            $table->integer('team_one_result')->default(0);
            $table->integer('team_two_result')->default(0);
            $table->unsignedBigInteger('team_win_id')->nullable();
            $table->integer('level')->default(1);
            $table->longText('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('team_one_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team_two_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
            $table->foreign('pitch_id')->references('id')->on('pitches')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('league_groups')->onDelete('cascade');
            $table->foreign('team_win_id')->references('id')->on('teams')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
