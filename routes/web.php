<?php

use Illuminate\Support\Facades\Route;
use trepro\Inspire\Controllers\InspirationController;
use trepro\Inspire\Inspire;
use trepro\Weather\Controllers\WeatherController;

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
    return view('welcome');
    
});

// Route::get('inspire', InspirationController::class);
Route::get('inspire', function() {
    $inspire = new Inspire;
    
    return $inspire->justDoIt();
});

Route::get('weather', function() {
    $weather = new WeatherController;

    return $weather->index();
});