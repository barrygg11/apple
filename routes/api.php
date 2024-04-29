<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TelegramSendApi;
use App\Http\Controllers\GitLabGetDataApi;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('TelegramSend/message={message}', [TelegramSendApi::class,'SendApi']);

Route::post('getGitLabApi', [GitLabGetDataApi::class,'getDataApi']);