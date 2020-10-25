<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => version_api(), 'namespace' => namespace_api()], function () {

    Route::post('login', 'UserController@access_token');
    Route::post('refresh_token', 'UserController@refresh_token');
    Route::post('user', 'UserController@postUser'); //sign up
    Route::post('confirm_code', 'UserController@postConfirmCode');
    Route::post('resend_confirm_code', 'UserController@resendConfirmCode');
    Route::post('forget', 'UserController@forget');

    Route::group(['middleware' => ['auth:api']], function () { //, 'verified'
        Route::get('profile/{id?}', 'UserController@getProfile');
        Route::put('user', 'UserController@putUser'); //edit profile or complete sign up
        Route::post('logout', 'UserController@logout');
        Route::post('players', 'UserController@getPlayers');


        Route::post('matches', 'MatchController@getMatches');

        Route::post('pitches', 'PitchController@getPitches');
        Route::get('pitch/{id}', 'PitchController@getPitch');

        Route::post('team', 'TeamController@createTeam');
        //unused
        Route::put('team/{id}', 'TeamController@updateTeam');
        Route::post('teams', 'TeamController@getTeams');
        Route::get('team/{id}', 'TeamController@getTeam');
        Route::post('invite_player', 'TeamController@invitePlayer');
        Route::post('join_league', 'TeamController@joinLeague');
        Route::post('cancel_subscription', 'LeagueController@cancelSubscription');
        Route::post('leave_player', 'TeamController@leavePlayer');


    });

    Route::group(['middleware' => 'authGuest:api'], function () {
//
        Route::get('home', 'HomeController@home');
        Route::get('lookups', 'LookUpController@lookUps');
        Route::post('leagues', 'LeagueController@getLeagues');
        Route::get('league/{id}', 'LeagueController@getLeague');
    });
//
//    Route::post('image',function (\App\Http\Requests\Api\Image\ImageRequest $request){
//
//
//        return response_api(true,200,null,empObj());
//    });

});
