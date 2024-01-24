<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobfolder\XmlController;
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


Route::get('/read', [XmlController::class, 'importXML']);

Route::get('/data', [GetdataFootball::class, 'GetTeamCountryIDs']);
Route::get('/fix', [GetdataFootball::class, 'GetTeamSchedule']);

//getSearch
Route::get('get/search', [SearchController::class, 'index']);

