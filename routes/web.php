<?php

use App\Http\Controllers\SeasonsController;
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
    Route::post('/series/destroy/{serie}','destroy')->name('series.destroy')->whereNumber('id');
    Route::get('/series/edit/{serie}','edit')->name('series.edit')->whereNumber('id');
    Route::post('/series/update/{serie}','update')->name('series.update');
});

Route::get('/series/{series}/seasons',[SeasonsController::class,'index'])->name('seasons.index');


