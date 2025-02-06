<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/search-users', [DashboardController::class, 'search'])->name('users.search');


Route::get('/users', [DashboardController::class, 'index'])->name('users.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Route::resource('user', UserController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    $users = User::all(); // Fetch all users from DB
    return response()->json($users); // Return JSON response
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/user/store', [DashboardController::class, 'store'])->name('user.store');

//Route::get('/user', [UserController::class, 'index'])->name('users.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/user/{id}', [DashboardController::class, 'edit'])->name('user.edit');
    Route::post('/user/store', [DashboardController::class, 'store'])->name('user.store');
    Route::delete('/user/{id}', [DashboardController::class, 'destroy'])->name('user.destroy');
});

//Route::middleware(['auth', 'admin'])->group(function () {
    //Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    //Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    //Route::post('/admin/user/update/{id}', [AdminController::class, 'updateUser']);
    //Route::delete('/admin/user/delete/{id}', [AdminController::class, 'deleteUser']);
//});

//Route::get('users', [UserController::class, 'index']);
//Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

require __DIR__.'/auth.php';
