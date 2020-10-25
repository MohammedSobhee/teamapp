<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('result_type_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('player_id')->nullable();
            $table->unsignedBigInteger('ref_id');
            $table->enum('type',['match','league']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('result_type_id')->references('id')->on('result_types')->onDelete('cascade');
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
        Schema::dropIfExists('results');
    }
}
