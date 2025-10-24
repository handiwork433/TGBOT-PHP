<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotWebhookController;
use App\Http\Controllers\CryptoWebhookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SignalController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AuditLogController;

Route::post('/bot/webhook', [BotWebhookController::class, 'handle']);
Route::post('/payments/cryptobot/webhook', [CryptoWebhookController::class, 'handle']);

Route::view('/health', 'health')->name('health');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');
    Route::resource('signals', SignalController::class);
    Route::get('queue', [QueueController::class, 'index'])->name('admin.queue.index');
    Route::post('queue/{job}/retry', [QueueController::class, 'retry'])->name('admin.queue.retry');
    Route::resource('plans', PlanController::class)->except(['show']);
    Route::resource('users', UserController::class)->only(['index', 'show', 'update']);
    Route::post('users/{user}/ban', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::post('users/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');
    Route::post('users/{user}/comp', [UserController::class, 'grantComplimentaryDays'])->name('admin.users.comp');
    Route::resource('payments', PaymentController::class)->only(['index', 'show']);
    Route::get('payments/export/csv', [PaymentController::class, 'exportCsv'])->name('admin.payments.export');
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('admin.settings.update');
    Route::get('logs', [AuditLogController::class, 'index'])->name('admin.logs.index');
});
