<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/api', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => 'throttle:' . config('api.rate_limits.access')], function () {
        // 未登录

        Route::apiResource('login','LoginController');
        
        Route::group(['middleware' => 'auth:api'], function () {
            // 已登录
            Route::apiResource('user','UserController');
        });

    });
});