<?php

use App\Livewire\ReportingLivewire;
use App\Livewire\Workers\EmergecyButtonLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to(route('filament.admin.auth.login'));
});

Route::get('/reporting', ReportingLivewire::class)->name('reporting');

Route::get('/emergecy', EmergecyButtonLivewire::class)->name('emergency-button');
