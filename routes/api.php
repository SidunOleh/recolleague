<?php

use App\Http\Controllers\Admin\ChatRequest\IndexSendingsController;
use App\Http\Controllers\Admin\ChatRequest\LatestSendingsController;
use App\Http\Controllers\Admin\ChatRequest\ShowController;
use App\Http\Controllers\Admin\ChatRequest\UpdateController;
use App\Http\Controllers\Admin\ChatRequestUser\LatestController;
use App\Http\Controllers\Admin\Content\IndexController as ContentIndexController;
use App\Http\Controllers\Admin\Content\UpdateController as ContentUpdateController;
use App\Http\Controllers\Admin\Coupons\IndexController as CouponsIndexController;
use App\Http\Controllers\Admin\Coupons\StoreController;
use App\Http\Controllers\Admin\Coupons\UpdateStatusController as CouponsUpdateStatusController;
use App\Http\Controllers\Admin\Users\DestroyController;
use App\Http\Controllers\Admin\Users\IndexController;
use App\Http\Controllers\Admin\Users\UpdateStatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/admin')->middleware(['auth:sanctum', 'user.admin',])->name('admin.')->group(function () {
    Route::prefix('/chat-request')->name('chat-request.')->group(function () {
        Route::get('/', ShowController::class)
            ->name('show');
        Route::put('/', UpdateController::class)
            ->name('update');
        // Route::get('/sendings/latest', LatestSendingsController::class)
        //     ->name('sendings.latest');
        Route::get('/sendings/{page?}', IndexSendingsController::class)
            ->where('page', '[0-9]+')
            ->name('sendings.index');
    });

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/{page?}', IndexController::class)
            ->where('page', '[0-9]+')
            ->name('index');
        Route::patch('/{user}/status/update', UpdateStatusController::class)
            ->name('status.update');
        Route::delete('/{user}', DestroyController::class)
            ->name('destroy');
    });

    Route::prefix('/coupons')->name('coupons.')->group(function () {
        Route::get('/{page?}', CouponsIndexController::class)
            ->where('page', '[0-9]+')
            ->name('index');
        Route::post('/', StoreController::class)
            ->name('store');
        Route::patch('/{coupon}/status/update', CouponsUpdateStatusController::class)
            ->name('status.update');
    });

    Route::prefix('/content')->name('content.')->group(function () {
        Route::get('/', ContentIndexController::class)
            ->name('index');
        Route::put('/', ContentUpdateController::class)
            ->name('update');
    });
});