<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiglyController;
use Laravel\Fortify\Fortify;

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

Route::get('/test', [PiglyController::class, 'test']);

Route::group(['prefix' => '/register'], function () {
    Route::get('/step1', [PiglyController::class, 'registerStep1'])->name('register');;
    Route::get('/step2', [PiglyController::class, 'registerStep2']);
    Route::post('/step2', [PiglyController::class, 'setWeight']);
});

Route::group(['prefix' => '/weight_logs'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [PiglyController::class, 'weightLogs']);
        Route::get('/goal_setting', [PiglyController::class, 'goalSetting']);
        Route::post('/goal_setting', [PiglyController::class, 'updateTarget']);
        Route::get('/search', [PiglyController::class, 'search']);
        Route::post('/create', [PiglyController::class, 'create']);
        Route::group(['prefix' => '/{weightLogId}'], function () {
            Route::get('/', [PiglyController::class, 'detail']);
            Route::post('/update', [PiglyController::class, 'updateLog']);
            Route::get('/delete', [PiglyController::class, 'delete']);
        });
    });
});
