<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/reset-password', function () {
    return 'Reset password successfully';
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/user/verify_page', 'Auth\RegisterController@verifyingPage');


Route::prefix('admin')->group(function () {

    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');

    //admin password reset routes
    Route::post('/password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::group(['middleware' => ['auth:admin', 'check-active']], function () {

        Route::get('/', 'AdminController@index')->name('admin.dashboard');

        Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'bookings'], function () {
            Route::get('/list', 'BookingController@index');
        });
        Route::group(['prefix' => 'transactions'], function () {
            Route::get('/list', 'TransactionController@index');
        });
        Route::group(['prefix' => 'teams'], function () {
            Route::get('/list', 'TeamController@index');
            Route::get('/team-data', 'TeamController@anyData');
            Route::get('/view/{id}', 'TeamController@view');
            Route::put('/change-league-status/{team_id}/{league_id}', 'TeamController@changeStatus');

        });
        Route::group(['prefix' => 'leagues'], function () {
            Route::get('/list', 'LeagueController@index');
            Route::get('/league-data', 'LeagueController@anyData');
            Route::get('/add', 'LeagueController@add');
            Route::post('/add', 'LeagueController@createLeague');
            Route::get('/view/{id}', 'LeagueController@view');
            Route::get('/edit/{id}', 'LeagueController@edit');
            Route::put('/change-status/{id}', 'LeagueController@changeStatus');
            Route::put('/edit/{id}', 'LeagueController@updateLeague');
            Route::get('/add-team/{id}', 'LeagueController@addTeamLeague');
            Route::post('/add-team/{id}', 'LeagueController@postTeamLeague');
            Route::delete('/remove-team/{league_id}/{team_id}', 'LeagueController@removeTeamLeague');
            Route::get('/teams-not-league-data', 'LeagueController@teamNotLeagueData');
        });
        Route::group(['prefix' => 'groups'], function () {
            Route::post('/create', 'GroupController@postGroup');
            Route::get('/league-group-data', 'GroupController@LeagueGroupData');
            Route::delete('/league-group/{id}', 'GroupController@deleteLeagueGroup');

        });
        Route::group(['prefix' => 'matches'], function () {
            Route::get('/list', 'MatchController@index');
            Route::get('/match-data', 'MatchController@anyData');
            Route::get('/edit/{id}', 'MatchController@edit');
            Route::put('/edit/{id}', 'MatchController@update');
            Route::post('/record', 'MatchController@record');
            Route::delete('/record/{id}', 'MatchController@deleteRecord');
            Route::get('/view/{id}', 'MatchController@view');
            Route::put('/change-status/{id}', 'MatchController@changeStatus');

        });
        Route::group(['prefix' => 'pitches'], function () {
            Route::get('/list', 'PitchController@index');
            Route::get('/add', 'PitchController@add');
            Route::get('/view/{id}', 'PitchController@view');

            Route::get('/pitch-data', 'PitchController@anyData');
            Route::post('/create', 'PitchController@store');
            Route::get('/{id}/edit', 'PitchController@edit');
            Route::put('/{id}/edit', 'PitchController@update');
            Route::delete('/{id}/delete', 'PitchController@delete');


        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/list', 'UserController@index');
            Route::get('/admins', 'AdminController@index');
            Route::get('/user-data/{type}', 'UserController@anyData');
            Route::get('/admin-data', 'AdminController@anyData');
            Route::get('/create', 'UserController@create');
            Route::post('/create', 'UserController@store');
            Route::delete('/delete-admin/{id}', 'AdminController@delete');
            Route::delete('/delete-user/{id}', 'UserController@delete');
            Route::get('/create-admin', 'AdminController@create');
            Route::post('/create-admin', 'AdminController@store');
            Route::get('/edit-admin/{id}', 'AdminController@edit');
            Route::put('/edit-admin/{id}', 'AdminController@update');
            Route::put('/admin/{id}/status', 'AdminController@changeStatus');
            Route::put('/user/{id}/status', 'UserController@changeStatus');
            Route::get('/profile/{id?}', 'AdminController@profile');
            Route::put('/profile/{id?}', 'AdminController@update');
//            Route::get('/edit-player/{id}', 'UserController@editPlayer');
            Route::get('/edit/{id}', 'UserController@edit');
            Route::put('/edit/{id}', 'UserController@update');
            Route::put('/edit-pitch-owner/{id}', 'UserController@updateOwner');

        });
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/positions', 'PositionController@index');
            Route::get('/positions', 'PositionController@index');
            Route::get('/positions/positions-data', 'PositionController@anyData');
            Route::get('/positions/create', 'PositionController@create');
            Route::post('/positions/create', 'PositionController@store');
            Route::get('/positions/{id}/edit', 'PositionController@edit');
            Route::put('/positions/{id}/edit', 'PositionController@update');
            Route::put('/positions/{id}/status', 'PositionController@changeStatus');
            Route::delete('/positions/{id}', 'PositionController@delete');


            Route::get('/results', 'ResultController@index');
            Route::get('/results/results-data', 'ResultController@anyData');
            Route::get('/results/create', 'ResultController@create');
            Route::post('/results/create', 'ResultController@store');
            Route::get('/results/{id}/edit', 'ResultController@edit');
            Route::put('/results/{id}/edit', 'ResultController@update');
            Route::put('/results/{id}/status', 'ResultController@changeStatus');
            Route::delete('/results/{id}', 'ResultController@delete');

            Route::get('/stats', 'StatsController@index');
            Route::get('/stats/stats-data', 'StatsController@anyData');
            Route::get('/stats/create', 'StatsController@create');
            Route::post('/stats/create', 'StatsController@store');
            Route::get('/stats/{id}/edit', 'StatsController@edit');
            Route::put('/stats/{id}/edit', 'StatsController@update');
            Route::put('/stats/{id}/status', 'StatsController@changeStatus');
            Route::delete('/stats/{id}', 'StatsController@delete');
//            Route::get('/stats/create', 'StatsController@edit');

        });
        Route::group(['prefix' => 'articles'], function () {
            Route::get('/list', 'ArticleController@index');
//            Route::get('/add', 'ArticleController@add');
            Route::get('/articles-data', 'ArticleController@anyData');
            Route::get('/create', 'ArticleController@create');
            Route::post('/create', 'ArticleController@store');
            Route::get('/{id}/edit', 'ArticleController@edit');
            Route::put('/{id}/edit', 'ArticleController@update');
            Route::put('/{id}/status', 'ArticleController@changeStatus');
            Route::delete('/{id}', 'ArticleController@delete');

        });
    });

    Route::group(['middleware' => 'authGuest:api', 'checkActiveUser'], function () {

    });
});
