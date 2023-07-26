<?php

use App\Http\Controllers\Api\EpisodesController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Models\Series;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('/series',SeriesController::class);

    Route::get('/series/{series}/seasons', [SeasonsController::class,'index']);

    Route::get('/series/{series}/episodes', [EpisodesController::class,'index']);

    Route::patch('/episodes/{episode}', [EpisodesController::class,'watched']);
});

Route::post('/login',[LoginController::class, 'singin']);