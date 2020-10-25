<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->date('date_from');
            $table->date('date_to');
            $table->enum('status', ['new', 'current', 'finished'])->default('new'); // 'upcoming','ongoing','ended'
            $table->unsignedBigInteger('city_id');
            $table->integer('teams_no');
//            $table->enum('status', ['new', 'current', 'finished'])->default('new');
            $table->enum('type', ['cup', 'tournament']);
            $table->integer('main_player_no');
            $table->integer('reserved_player_no');
            $table->date('registration_deadline');
            $table->enum('payment_type', ['paid', 'free']);
            $table->double('payment_cost')->nullable();
            $table->longText('condition_text')->nullable();
            $table->unsignedBigInteger('team_win_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('leagues');
    }
}
