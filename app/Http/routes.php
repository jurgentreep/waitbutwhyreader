<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    $article = new stdClass();
    $article->title = 'Wait But Why';
    return view('welcome', compact('article'));
});
Route::get('{year}/{month}/{page}', 'ScrapeController@index');
