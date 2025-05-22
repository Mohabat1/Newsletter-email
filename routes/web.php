<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Рассылки
    Route::prefix('campaign')->group(function() {
        Route::get('/send', [CampaignController::class, 'create'])->name('campaign.form');
        Route::post('/send', [CampaignController::class, 'send'])->name('campaign.send');
        // Добавляем недостающий маршрут
        Route::get('/', [CampaignController::class, 'index'])->name('campaigns.index');
    });
});

require __DIR__.'/auth.php';
