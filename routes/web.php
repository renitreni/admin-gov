<?php

use App\Livewire\ReportingLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to(route('filament.admin.auth.login'));
});

Route::get('/reporting', ReportingLivewire::class)->name('reporting');