<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('series.index');
});

Route::controller(SeriesController::class)->group(function(){
    Route::get('/series','index')->name('series.index');
    Route::get('/series/create','create')->name('series.create');
    Route::post('/series/store','store')->name('series.store');
    Route::post('/series/destroy/{id}','destroy')->name('series.destroy')->whereNumber('id');
});


