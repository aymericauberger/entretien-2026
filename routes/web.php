<?php

use App\Http\Controllers\ReceiveWebhookController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::post('webhooks/contacts', ReceiveWebhookController::class)
    ->name('webhooks.contacts');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
