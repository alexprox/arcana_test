<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHomePage'));

Route::get('/signUp', array('as' => 'signUp', 'uses' => 'HomeController@showHomePage'));
Route::get('/signIn', array('as' => 'signIn', 'uses' => 'HomeController@showHomePage'));

Route::post('/signUp', array('as' => 'signUp', 'uses' => 'UserController@signUp'));
Route::post('/signIn', array('as' => 'signIn', 'uses' => 'UserController@signIn'));
Route::any('/signOut', array('as' => 'signOut', 'uses' => 'UserController@signOut'));

Route::post('/tweet', array('as' => 'writeTweet', 'uses' => 'SparrowController@writeTweet'));
Route::post('/reply', array('as' => 'replyTweet', 'uses' => 'SparrowController@replyTweet'));
Route::post('/retweet', array('as' => 'retweet', 'uses' => 'SparrowController@retweet'));

Route::get('/user/{name}', array('as' => 'findUser', 'uses' => 'UserController@findUser'))->where('name', '\w+');

Route::filter('csrf', function() {
    $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
    if (Session::token() != $token) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});
