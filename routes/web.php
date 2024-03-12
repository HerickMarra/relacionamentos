<?php

use App\Http\Controllers\app\EmotionController;
use App\Http\Controllers\app\IndicatorController;
use App\Http\Controllers\app\NotificationController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\painel\PainelController;
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
    return view('welcome');
});


Route::group([
    'prefix' => '/login',
], function () {
    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/', [LoginController::class, 'login'])->name('loginAuth');
});

Route::group([
    'prefix' => '/painel',
    'middleware' => ['auth','lastlogin']
], function () {
    Route::get('/', [PainelController::class, 'index'])->name('painel');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group([
    'prefix' => '/notification',
    'middleware' => ['auth','lastlogin']
], function () {
    Route::get('/count', [NotificationController::class, 'count'])->middleware('auth')->name('get.notification.count');
    // Route::post('/', [LoginController::class, 'login'])->name('loginAuth');
});


Route::group([
    'prefix' => '/indicators',
    'middleware' => ['auth','lastlogin']
], function () {
    Route::post('/create', [EmotionController::class, 'createEmotion'])->middleware('auth')->name('indicator.create');
    // Route::post('/', [LoginController::class, 'login'])->name('loginAuth');
});
