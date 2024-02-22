<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobfolder\news_collection;
use App\Http\Controllers\Api\GetdataFootball;
use App\Http\Controllers\Api\SearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/read', [news_collection::class, 'importXML']);

Route::get('/data', [GetdataFootball::class, 'GetTeamCountryIDs']);
Route::get('/fix', [GetdataFootball::class, 'GetTeamSchedule']);

//getSearch
Route::get('get/search', [SearchController::class, 'index']);

Route::get('get', [GetdataFootball::class, 'GetTeamDateHistory']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('userData', [AuthController::class, 'me']);
    // Route::post('logout', [AuthController::class, 'logout']);
});

