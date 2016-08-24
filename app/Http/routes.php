<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function() {
    return 'Hello world';
});

$app->get('/b/{size}/{id}.{extension}', ['as' => 'bttv', 'uses' => 'EmotesController@bttv']);
$app->get('/t/{size}/{id}', ['as' => 'twitch', 'uses' => 'EmotesController@twitch']);
