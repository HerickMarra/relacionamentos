<?php

use App\Http\Controllers\app\EmotionController;
use App\Http\Controllers\app\IndicatorController;
use App\Http\Controllers\app\NotificationController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\painel\EventController;
use App\Http\Controllers\painel\PainelController;
use App\Http\Controllers\painel\RecordController;
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


// AUTH
Route::group([
    'prefix' => '/login',
], function () {
    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/', [LoginController::class, 'login'])->name('loginAuth');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------  AUTH  ----------



Route::group([
    'prefix' => '/painel',
    'middleware' => ['auth','lastlogin']
], function () {
    Route::get('/', [PainelController::class, 'index'])->name('painel');
});



Route::group([
    'prefix' => '/notification',
    'middleware' => ['auth','lastlogin']
], function () {
    Route::get('/count', [NotificationController::class, 'count'])->middleware('auth')->name('get.notification.count');
    Route::get('/itens', [NotificationController::class, 'getItens'])->middleware('auth')->name('get.notification.itens');
    Route::get('/item', [NotificationController::class, 'getItem'])->middleware('auth')->name('get.notification.item');
    // Route::post('/', [LoginController::class, 'login'])->name('loginAuth');
});


Route::group([
    'prefix' => '/emotion',
    'middleware' => ['auth','lastlogin']
], function () {
    Route::post('/create', [EmotionController::class, 'createEmotion'])->middleware('auth')->name('indicator.create');
    Route::get('/{id}', [EmotionController::class, 'index'])->middleware('auth')->name('indicator.index');
    // Route::post('/', [LoginController::class, 'login'])->name('loginAuth');
});


Route::group([
    'prefix' => '/record',
    'middleware' => ['auth','lastlogin']
], function () {
    Route::get('/', [RecordController::class, 'index'])->middleware('auth')->name('record');
    Route::post('/', [RecordController::class, 'get'])->middleware('auth')->name('record');
    Route::post('/create', [RecordController::class, 'create'])->middleware('auth')->name('record.create');
    // Route::post('/', [LoginController::class, 'login'])->name('loginAuth');
});


Route::resource('events', EventController::class);




