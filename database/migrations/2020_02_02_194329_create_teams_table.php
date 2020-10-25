<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('bg_image')->nullable();
            $table->enum('type', ['public', 'invite']);
//            $table->integer('players_num')->default(0);
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->unsignedBigInteger('captain_id')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->longText('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('captain_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
