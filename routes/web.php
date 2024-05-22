<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminQuizController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\FrontHomeController;
use Illuminate\Support\Facades\Route;


// Front Routes
Route::get('/', [FrontHomeController::class, 'home'])->name('home');

// User authentication routes
Route::group(['prefix' => 'account'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('account.profile');
        Route::POST('/submit-quiz', [FrontHomeController::class, 'submitQuiz'])->name('submit.quiz')->middleware('checkQuizSubmission');;
        Route::get('/quiz-results', [FrontHomeController::class, 'quizResults'])->name('quiz.results');
        Route::get('/answers-list', [FrontHomeController::class, 'listUserAnswers'])->name('answers.list');
        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');
    });
});

// Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'adminLogin'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminQuizController::class, 'create'])->name('admin.dashboard');
        Route::post('/store', [AdminQuizController::class, 'store'])->name('admin.store');
        Route::get('/list', [AdminQuizController::class, 'index'])->name('admin.list');
        Route::get('/quiz-result/{quizId}', [AdminQuizController::class, 'quizResult'])->name('admin.quiz-result');
        // new route
        // Add this route within your existing admin group
        Route::get('/admin/quiz-best-answers/{quizId}', [AdminQuizController::class, 'quizBestAnswers'])->name('admin.quiz-best-answers');

        Route::get('/logout', [AdminQuizController::class, 'logout'])->name('admin.logout');
    });
});
