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

// SOCIAL

Route::get('auth/{provider}', 'SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'SocialAuthController@handleProviderCallback')->name('social.callBack');

// FAQ

Route::get('/faq', 'FaqController@faqs')->name('faqs')->middleware('auth');

// LOGIN

Route::get('/', 'LoginController@login')->name('login');
Route::get('/register', 'LoginController@register')->name('register');
Route::get('/validate/login', 'LoginController@validateLogin')->name('validateLogin');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/home', 'LoginController@home')->name('home')->middleware('auth');

// Password reset routes

Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

// USER

Route::get('/users', 'UserController@users')->name('users')->middleware('auth');
Route::get('/user/{id}', 'UserController@user')->name('user')->middleware('auth');
Route::get('/changeUserAvatar/{id}', 'UserController@changeUserAvatar')->name('changeUserAvatar')->middleware('auth');
Route::post('/user/store', 'UserController@store')->name('user.store');
Route::post('/user/update', 'UserController@update')->name('user.update')->middleware('auth');
Route::get('/profile', 'UserController@userProfile')->name('user.profile')->middleware('auth');
Route::get('/notifications', 'UserController@notifications')->name('user.notifications')->middleware('auth');
Route::get('/privacity', 'UserController@privacity')->name('privacity');

// BET

Route::get('/bets', 'BetController@bets')->name('bets')->middleware('auth');
Route::get('/bet/{id}', 'BetController@bet')->name('bet')->middleware('auth');
Route::post('/bet/store','BetController@store')->name('bet.store')->middleware('auth');

// TOURNAMENT

Route::get('/tournament/{id}', 'TournamentController@tournament')->name('tournament')->middleware('auth');

// FORUM

Route::get('/forum', 'ForumController@forum')->name('forum')->middleware('auth');
Route::post('/topic','ForumController@topic')->name('topic')->middleware('auth');
Route::post('/topic/store','ForumController@storeTopic')->name('topic.store')->middleware('auth');
Route::get('/topic/destroy/{id}', 'ForumController@destroyTopic')->name('topic.destroy')->middleware('auth');
Route::post('/reply/store','ForumController@storeReply')->name('reply.store')->middleware('auth');
Route::get('/forum/slidePanel/{id}', 'ForumController@slidePanel')->name('forum.slidePanel')->middleware('auth');

// GROUP

Route::get('/groups', 'GroupController@groups')->name('groups')->middleware('auth');
Route::get('/group/{id}', 'GroupController@group')->name('group')->middleware('auth');
Route::get('/group/destroy/{id}', 'GroupController@destroy')->name('group.destroy')->middleware('auth');
Route::post('/group/store', 'GroupController@store')->name('group.store')->middleware('auth');
Route::post('/group/update', 'GroupController@update')->name('group.update')->middleware('auth');
Route::post('/group/storeInvitations', 'GroupController@storeInvitations')->name('group.storeInvitations')->middleware('auth');
Route::get('/group/confirmGroup/{id}', 'GroupController@confirmGroup')->name('group.confirmGroup')->middleware('auth');
Route::get('/group/deleteInvitation/{id}', 'GroupController@deleteInvitation')->name('group.deleteInvitation')->middleware('auth');

// MESSAGE

Route::post('/message/store','MessageController@store')->name('message.store')->middleware('auth');
Route::post('/message/storeAjax','MessageController@storeAjax')->name('message.storeAjax')->middleware('auth');

// ADMINISTRATOR

Route::group( ['prefix' => 'admin', 'as' => 'admin.'], function () {

    // MATCH

    Route::get('/admin/matches', 'MatchController@adminMatches')->name('matches')->middleware('admin');
    Route::post('/admin/match/finished', 'MatchController@adminMatchFinished')->name('match.finished')->middleware('admin');

});

// NOTIFICATIONS

Route::get('/markAsRead', function (){
    echo auth()->user()->unreadNotifications->markAsRead();

});

// CHAT

Route::get('/chat', 'UserController@chat')->name('chat')->middleware('auth');
Route::get('/chatMessage/{id}', 'UserController@chatMessage')->name('chatMessage')->middleware('auth');

// LIKE

Route::post('/like/storeAjax','LikeController@storeAjax')->name('like.storeAjax')->middleware('auth');

// SPECIAL EVENT

Route::get('/evento-especial/felicitaciones/evento1', 'UserController@specialEvent')->name('specialEvent1')->middleware('auth');