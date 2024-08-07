<?php

use App\Models\NotificationKey;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Contract\Messaging;
use App\Http\Controllers\HomeController;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\WebPushConfig;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('download-file', 'notifymessage')->name('download');
    Route::post('firebase-storekey', 'firebase_store_key')->name('firebase.store_key');

    Route::post('firebase-declinekey', 'firebase_decline_key')->name('firebase.decline_key');

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




// Route::get('t1', function (Messaging $fcm) {
//     $token = 'd8XaDwIOBeI:APA91bGa-mlwvgLMEkk3wKntDmQ2wxuHCcqthfO6NtWFculDUuI56PLQ6cA3oYcm1M10wBPeE5RxPgcO0GaQI3bkocBO8gjNEg1Kb8pehMYjWqGx91lU9iwiKiCpOT-4r2e_RXXzsRyR';

//     $webPushConfig = WebPushConfig::fromArray([
//         'notification' => [
//             'title' => __('Testing Firebase Click action for :app app', ['app' => date('Y-m-d H:i:s')]),
//             'body' => '$GOOG gained 11.80 points to close at 835.67, up 1.43% on the day.',
//             'icon' => 'https://raziul.dev/images/raziul-islam.webp',
//         ],
//         'fcm_options' => [
//             'link' => 'https://raziul.dev/simplify-slug-creation-for-eloquent-models',
//         ],
//     ]);

//     $message = CloudMessage::withTarget('token', $token)
//         ->withWebPushConfig($webPushConfig);

//     dd($fcm->send($message));
// });
