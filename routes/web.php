<?php

use App\Models\Kursus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KursusController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\KursusMateriController;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('admin', function () {
//     return '<h1>Hello Admin!</h1>';
// })->middleware(['auth', 'role:admin']);

// Route::get('userbiasa', function () {
//     return '<h1>Hello User!</h1>';
// })->middleware(['auth', 'role:user|admin']);

// Route::get('/', function () {
//     return '<h1>Halaman Awal!</h1>';
// })->middleware(['auth', 'role:user|admin']);

Route::middleware('auth')->group(function () {
    Route::get('/kursus', [KursusMateriController::class, 'index'])->name('kursus');

    Route::get('change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change.form');
    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('password.change');
});

Route::middleware('role:admin', 'auth')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');


    Route::prefix('user')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('user-list');
        Route::post('/store', [UserController::class, 'store'])->name('user-store');

        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');

        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user-edit');
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('user-update');
    });

    Route::prefix('kursus')->group(function () {
        Route::get('/list', [KursusController::class, 'index'])->name('kursus-list');
        Route::post('/store', [KursusController::class, 'store'])->name('kursus-store');

        Route::get('/show/{id}', [KursusController::class, 'show'])->name('kursus-show');

        Route::delete('/destroy/{id}', [KursusController::class, 'destroy'])->name('kursus-destroy');

        Route::get('/edit/{id}', [KursusController::class, 'edit'])->name('kursus-edit');
        Route::put('/edit/{id}', [KursusController::class, 'update'])->name('kursus-update');
    });

    Route::prefix('materi')->group(function () {
        Route::get('/list', [MateriController::class, 'index'])->name('materi-list');
        Route::post('/store', [MateriController::class, 'store'])->name('materi-store');

        Route::get('/show/{id}', [MateriController::class, 'show'])->name('materi-show');

        Route::delete('/destroy/{id}', [MateriController::class, 'destroy'])->name('materi-destroy');

        Route::get('/edit/{id}', [MateriController::class, 'edit'])->name('materi-edit');
        Route::put('/edit/{id}', [MateriController::class, 'update'])->name('materi-update');
    });
});
