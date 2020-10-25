<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeagueTeamGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_team_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('league_group_id');
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('team_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('league_group_id')->references('id')->on('league_groups')->onDelete('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('league_team_groups');
    }
}
