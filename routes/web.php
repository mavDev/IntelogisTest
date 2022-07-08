<?php

use App\Http\Controllers\CalculateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/',function (){
    dd(config('app.debug'));
});*/
Route::get('/', HomeController::class)->name('home');
Route::post('/', CalculateController::class)->name('calculate');

