<?php

use App\Livewire\ReportingLivewire;
use App\Livewire\Worker\Auth\LoginLivewire;
use App\Livewire\Workers\EmergencyButtonLivewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->to(route('filament.admin.auth.login'));
});

Route::get('/reporting', ReportingLivewire::class)->name('reporting');

Route::middleware(['auth:worker'])->group(function () {
    Route::get('/emergency', EmergencyButtonLivewire::class)->name('emergency-button');
});

Route::get('/worker/login', LoginLivewire::class)->name('login');

Route::get('/worker/logout', function () {
    Auth::guard('worker')->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('emergency-button');
})->name('worker.logout');
