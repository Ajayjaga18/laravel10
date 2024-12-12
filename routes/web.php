<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\FaqController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('forget-password', [UserController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('forget-password-sendmail', [UserController::class, 'forgetPasswordSendMail'])->name('forgetPasswordSendMail');
Route::get('updatePasswordBladeFile/{user}', [UserController::class, 'updatePasswordBladeFile'])->name('updatePasswordBladeFile');
Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');

Route::get('/dashboard', function () {
    return view('admin.dashbord.dashborad');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('dashoard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::get('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('faqs', FaqController::class);
        Route::get('faqs/search', [FaqController::class, 'search'])->name('faqs.search');
    });
});

require __DIR__ . '/auth.php';
