<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TestController;









Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('download-file',  'notifymessage')->name('download');
    Route::post('firebase-storekey',  'firebase_store_key')->name('firebase.store_key');

    Route::post('firebase-declinekey',  'firebase_decline_key')->name('firebase.decline_key');


    Route::get('offline-page.html', 'offLine')->name('offline');
    Route::get('send', 'notification_send')->name('notify');
    Route::get('git-pull', 'gitPull')->name('gitpull');
    Route::get('send-pending-notification', 'sendNotification')->name('send-pending-notification');
});


Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest:admin');
Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('guest:admin');

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('send-notification', [DashboardController::class, 'send_notification'])->name('admin.send_notification');
    Route::get('category-wise/{category}', [DashboardController::class, 'category_wise'])->name('admin.category_wise');
    Route::post('category-wise-send/{category}', [DashboardController::class, 'send_category_wise_store'])->name('admin.send_category_wise');

    Route::get('send-to-all', [DashboardController::class, 'send_to_all'])->name('admin.send_to_all');

    Route::post('send-to-all', [DashboardController::class, 'send_to_all_store'])->name('admin.send_to_all_store');

    Route::get('notification-history', [DashboardController::class, 'notification_history'])->name('admin.notification_history');

    Route::get('clear-history', [DashboardController::class, 'clear_history'])->name('admin.clear_history');

    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});
