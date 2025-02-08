<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;



Route::get('/users', [UserController::class, 'index']);
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');



Route::get('/search-users', [DashboardController::class, 'search'])->name('users.search');

//model
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');


// Route::get('/users', [DashboardController::class, 'index'])->name('users.index');
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/user/{id}', [DashboardController::class, 'edit'])->name('user.edit');
    Route::post('/user/store', [DashboardController::class, 'store'])->name('user.store');
    Route::delete('/user/{id}', [DashboardController::class, 'destroy'])->name('user.destroy');
});

Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
