<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublikController;
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

Route::get('/', [PublikController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function(){
    Route::middleware('admin')->prefix('admin')->group(function (){
        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::prefix('jadwal')->group(function (){
            // Route::get('/', [AdminController::class, 'getJadwal']);
            Route::get('/history', [AdminController::class, 'getHistory']);
            Route::get('/input', [AdminController::class, 'addJadwal']);
            Route::post('/input', [AdminController::class, 'saveJadwal']);
        });

    });

    // user
    Route::get('/dashboard', [AdminController::class, 'index']);
});
