<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to(route('filament.admin.auth.login'));
});
