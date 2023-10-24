<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\RunningController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
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
Route::get('/flip', [PublikController::class, 'flip']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'getJadwal']);
        Route::get('/running', [AdminController::class, 'getRunningText']);
        Route::prefix('jadwal')->group(function () {
            Route::get('/', [AdminController::class, 'getJadwal']);
            Route::get('/history', [AdminController::class, 'getHistory']);
            Route::get('/input', [AdminController::class, 'addJadwal']);
            Route::post('/input', [AdminController::class, 'saveJadwal']);
            Route::get('/{id}/edit', [AdminController::class, 'editJadwal']);
            Route::post('/{id}/edit', [AdminController::class, 'updateJadwal']);
            Route::get('/{id}/hapus', [AdminController::class, 'deleteJadwal']);
        });

        Route::prefix('user-management')->group(function () {
            Route::get('/', [UserManagementController::class, 'index']);
            Route::get('/input', [UserManagementController::class, 'add']);
            Route::post('/store', [UserManagementController::class, 'store']);
            Route::get('/{id}/edit', [UserManagementController::class, 'edit']);
            Route::post('/{id}/edit', [UserManagementController::class, 'update']);
            Route::get('/{id}/hapus', [UserManagementController::class, 'destroy']);
        });

        Route::prefix('konten')->group(function () {
            Route::get('/', [KontenController::class, 'index']);
            Route::get('/input', [KontenController::class, 'add']);
            Route::post('/store', [KontenController::class, 'store']);
            Route::get('/{id}/edit', [KontenController::class, 'edit']);
            Route::post('/{id}/edit', [KontenController::class, 'update']);
            Route::get('/{id}/hapus', [KontenController::class, 'destroy']);
        });

        Route::prefix('running')->group(function () {
            Route::get('/', [RunningController::class, 'index']);
            Route::get('/input', [RunningController::class, 'add']);
            Route::post('/store', [RunningController::class, 'store']);
            Route::get('/{id}/edit', [RunningController::class, 'edit']);
            Route::post('/{id}/edit', [RunningController::class, 'update']);
            Route::get('/{id}/hapus', [RunningController::class, 'destroy']);
        });

    });

    Route::middleware('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'getJadwal']);
        Route::get('/running', [UserController::class, 'getRunningText']);
        Route::prefix('jadwal')->group(function () {
            Route::get('/', [UserController::class, 'getJadwal']);
            Route::get('/history', [UserController::class, 'getHistory']);
            Route::get('/input', [UserController::class, 'addJadwal']);
            Route::post('/input', [UserController::class, 'saveJadwal']);
        });
    });
});