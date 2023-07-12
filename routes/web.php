<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
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

Route::controller(SeriesController::class)->group(function(){
    Route::get('/series','index')->name('series.index');
    Route::get('/series/create','create')->name('series.create');
    Route::post('/series/store','store')->name('series.store');
    Route::post('/series/destroy/{serie}','destroy')->name('series.destroy')->whereNumber('id');
    Route::get('/series/edit/{serie}','edit')->name('series.edit')->whereNumber('id');
    Route::post('/series/update/{serie}','update')->name('series.update');
});

Route::middleware(Autenticador::class)->group(function (){
    Route::get('/', function () {
        return to_route('series.index');
    });
    Route::get('/series/{series}/seasons',[SeasonsController::class,'index'])->name('seasons.index');
    Route::get('/seasons/{series}/{season}/episodes',[EpisodesController::class,'index'])->name('episodes.index');
    Route::post('/seasons/{series}/{season}/episodes',[EpisodesController::class,'update'])->name('episodes.update');
});



Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'singin'])->name('login.singin');
Route::get('/logout',[LoginController::class,'destroy'])->name('logout');

Route::get('/register',[UsersController::class,'create'])->name('users.register');
Route::post('/register',[UsersController::class,'store'])->name('users.store');


