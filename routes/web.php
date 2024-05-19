<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminQuizController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\FrontHomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('admin.app');
// });
// routes/web.php

// Admin Routes
Route::get('/', [FrontHomeController::class, 'home'])->name('home');
// Route::get('/dashboard', [AdminQuizController::class, 'create'])->name('admin.create');

// Front Routes

Route::group(['prefix' => 'account'], function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
    });
});

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminQuizController::class, 'create'])->name('admin.dashboard');
        Route::get('/logout', [AdminQuizController::class, 'logout'])->name('admin.logout');
    });
});
