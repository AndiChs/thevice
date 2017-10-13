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

Auth::routes();



Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/profile', 'HomeController@profile')->name('home.profile');

Route::get('/online', 'HomeController@online')->name('home.online');

Route::get('/staff', 'HomeController@staff')->name('home.staff');

Route::get('/searchplayer', 'HomeController@searchPlayer')->name('home.searchPlayer');

Route::get('/search/{name}/', 'HomeController@search')->name('home.search');

Route::get('/profile/{username}', 'HomeController@profile')->name('home.profile');

Route::get('/businesses', 'HomeController@businesses')->name('home.businesses');

Route::get('/houses', 'HomeController@houses')->name('home.houses');

Route::get('/topplayers', 'HomeController@topPlayers')->name('home.top50users');

Route::get('/wars', 'HomeController@wars')->name('home.wars');

Route::get('/war/{id}', 'HomeController@war')->name('home.war');

Route::get('/dealership', 'HomeController@dealership')->name('home.dealership');

Route::get('/terms', 'HomeController@terms')->name('home.terms');

Route::get('/privacy', 'HomeController@privacy')->name('home.privacy');

Route::get('/banlist', 'HomeController@banList')->name('home.bans');

Route::get('/updates', 'HomeController@serverUpdates')->name('home.updates');

//Route::resource('/faction/application', 'Application@index');

//Clan Routes

Route::get('/clan/{id}', 'ClansController@show')->name('clan.show');

Route::get('/clans', 'ClansController@index')->name('clan.index');

//Groups Routes

Route::get('/factions', 'GroupsController@index')->name('group.index');

Route::get('/faction/members/{id}', 'GroupsController@members')->name('group.members');

Route::get('/faction/logs/{id}', 'GroupsController@logs')->name('group.logs');


//===========================================[Applications]=============================================================
Route::get('/faction/applications/show/{id}', 'ApplicationController@show')->name('application.show');


//===========================================[Complaints]===============================================================
Route::get('/complaints', 'ComplaintsController@index')->name('complaint.index');


Route::group(['middleware'=>'auth'],function () {
    //=============================================[Users]==============================================================
    Route::post('/user/changePassword/', 'UserController@changeUserPassword');
    Route::get('/user/notifications', 'UserController@notifications')->name('user.notifications');
    //===========================================[Tickets]==============================================================
    Route::get('/tickets', 'TicketController@index')->name('ticket.index');
    Route::get('/ticket/create', 'TicketController@create')->name('ticket.create');
    Route::post('/ticket/store/', 'TicketController@store');
    Route::get('/ticket/show/{id}', 'TicketController@show')->name('ticket.show');
    Route::patch('/ticket/update/{id}', 'TicketController@update');
    Route::post('/ticket/comment/{id}', 'TicketController@storeComment');

    //===========================================[Complaints]===========================================================
    Route::get('/complaint/create/{id}', 'ComplaintsController@create')->name('complaint.create');
    Route::post('/complaint/store/{id}', 'ComplaintsController@store');
    Route::post('/complaint/comment/{id}', 'ComplaintsController@storeComment');
    Route::patch('/complaint/updateStatus/{id}', 'ComplaintsController@update');
    Route::get('/complaints/faction/{id}', 'ComplaintsController@group')->name('complaint.group');
    Route::get('/complaint/show/{id}', 'ComplaintsController@show')->name('complaint.show');

    //===========================================[Applications]=========================================================
    Route::get('/faction/applications/create/{id}', 'ApplicationController@create')->name('application.create');
    Route::post('/faction/applications/store/{id}', 'ApplicationController@store');
    Route::patch('/faction/applications/update/{id}', 'ApplicationController@update');
    Route::get('/faction/applications/index/{id}', 'ApplicationController@index')->name('application.index');

    //===========================================[Unban Request]========================================================
    Route::get('/unban', 'UnbanRequestsController@index')->name('unban.index');
    Route::get('/unban/create', 'UnbanRequestsController@create')->name('unban.create');
    Route::post('/unban/store', 'UnbanRequestsController@store');
    Route::get('/unban/show/{id}', 'UnbanRequestsController@show')->name('unban.show');
    Route::patch('/unban/update/{id}', 'UnbanRequestsController@update');
    Route::post('/unban/comment/{id}', 'UnbanRequestsController@storeComment');

    //===============================================[Leader Panel]=====================================================
    Route::group(['middleware'=>'leader'],function (){
        Route::get('/faction/panel', 'GroupsController@panel')->name('group.panel');

        Route::patch('/faction/panel/updatequestions/{id}', 'GroupsController@updateQuestions');

        Route::patch('/faction/panel/updateapplcations/{id}', 'GroupsController@updateApplications');
    });
    //===============================================[Admin Panel]======================================================
    Route::group(['middleware'=>'isAdmin'],function (){
        Route::get('/admin/', 'AdminController@index')->name('admin.index');
        Route::post('/admin/storeUpdate', 'AdminController@storeUpdate');
    });
});

