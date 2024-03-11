<?php

use App\Http\Controllers\Admin\Auth\LogInController;
use App\Http\Controllers\Admin\Auth\LogOutController as AuthLogOutController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\ChatRequest\SendController;
use App\Http\Controllers\ChatRequest\SendPreviewController;
use App\Http\Controllers\Coupons\ApplyController;
use App\Http\Controllers\OAuth\CallbackController;
use App\Http\Controllers\OAuth\RedirectController;
use App\Http\Controllers\Pages\ChatController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Password\ResetController;
use App\Http\Controllers\Password\ResetFormController;
use App\Http\Controllers\Password\SendResetLinkController;
use App\Http\Controllers\Payment\SubscribeController;
use App\Http\Controllers\Payment\UpdateController;
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

Route::name('auth.')->group(function () {
    Route::post('/sign-in', SignInController::class)
        ->middleware(['guest',])
        ->name('sign-in');
    Route::post('/sign-up', SignUpController::class)
        ->middleware(['guest',])
        ->name('sign-up');
    Route::get('/logout', LogOutController::class)
        ->middleware(['auth',])
        ->name('logout');
});

Route::prefix('/oauth/{provider}')->middleware(['guest',])->name('oauth.')->group(function () {
    Route::get('/redirect', RedirectController::class)
        ->name('redirect');
    Route::get('/callback', CallbackController::class)
        ->name('callback');
});

Route::prefix('/password')->name('password.')->group(function () {
    Route::post('/reset-link', SendResetLinkController::class)
        ->name('reset-link');
    Route::get('/reset/{token}', ResetFormController::class)
        ->name('reset');
    Route::post('/reset', ResetController::class)
        ->name('update');
});

Route::prefix('/payment')->middleware(['auth',])->name('payment.')->group(function () {
    Route::post('/subscribe', SubscribeController::class)
        ->name('subscribe');
    Route::post('/update', UpdateController::class)
        ->name('update');
});

Route::post('/coupons/apply', ApplyController::class)
    ->middleware(['auth', 'user.active',])
    ->name('coupons.apply');

Route::name('pages.')->group(function () {
    Route::get('/', HomeController::class)
        ->name('home');
    Route::get('/chat', ChatController::class)
        ->middleware(['auth', 'user.subscribed',])
        ->name('chat');
});

Route::get('/chat/request', SendController::class)
    ->middleware(['auth', 'user.active', 'user.subscribed',])
    ->name('chat.request');
Route::get('/chat/preview-request', SendPreviewController::class)
    ->middleware(['user.active', 'throttle:chat-request',])
    ->name('chat.preview-request');

// admin panel
Route::post('/admin/login', LogInController::class)
    ->name('admin.login');
Route::post('/admin/logout', AuthLogOutController::class)
    ->name('admin.logout');

Route::get('/admin/{any?}', IndexController::class)
    ->where('any', '.*')
    ->name('admin.index');
