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

//$app->get('/', function () use ($app) {
//    return $app->version();
//});

$app->get('/login', function (\Illuminate\Http\Request $request) {
    $token = app('auth')->attempt($request->only('email', 'password'));

    return response()->json(compact('token'));
});

$app->get('/me', function (\Illuminate\Http\Request $request) {
    return $request->user();
});


$app->get('/me2', function (\Illuminate\Http\Request $request) {
    $user = app('auth')->authenticate();
//    dd( app('auth'));
    return $user;
});

$app->group(['middleware' => 'auth:api'], function($app)
{
    $app->get('/test', function() {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    });
});