<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nick_name');
            $table->date('birth_date')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('country_id')->nullable(); // NationalityId
            $table->unsignedBigInteger('city_id')->nullable();
            $table->longText('address')->nullable();
            $table->unsignedBigInteger('primer_position_id')->nullable();
            $table->unsignedBigInteger('secondary_position_id')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('is_confirm_code')->default(false);
            $table->enum('favorite_leg', ['left', 'right'])->nullable();
            $table->enum('type', ['pitch_owner', 'player'])->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_complete_profile')->default(false);
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->longText('bio')->nullable();

            $table->double('commission')->nullable(); // for pitch_owner
            $table->double('discount')->nullable(); // for pitch_owner %

            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('primer_position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('secondary_position_id')->references('id')->on('positions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
