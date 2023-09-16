<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MencobaController;
use App\Http\Controllers\BukuController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about', [
        "name" => "naufal",
        "email" => "naufal@gmail.com"
    ]);
});

Route::get('/boom', [MencobaController::class, 'boomesport']);

Route::get('/prx', [MencobaController::class, 'prxesport']);

Route::get('/fnatic', [MencobaController::class, 'fnaticesport']);

Route::get('/fpx', [MencobaController::class, 'fpxesport']);

// Route::get('/', [MencobaController::class, 'beranda']);

Route::get('/buku', [BukuController::class, 'index']);