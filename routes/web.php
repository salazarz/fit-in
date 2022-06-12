<?php

use App\Http\Controllers\History;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;

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
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/camera', function () {
    return view('camera');
});

// Route::get('/profile', function () {
//     return view('profile');
// });

Route::post('/actionLogin', [Login::class, 'actionLogin'])->name('actionLogin');
Route::get('/actionLogout', [Login::class, 'actionLogout'])->name('actionLogout');
Route::post('/actionRegister', [Login::class, 'actionRegister'])->name('actionRegister');

Route::get('/profile', [History::class, 'historyView'])->name('historyView');
Route::get('/home', [History::class, 'homeView'])->name('homeView');

Route::post('/predict', [History::class, 'predict'])->name('predict');