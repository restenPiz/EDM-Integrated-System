<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'pages.auth.login')
    ->name('login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//*Start with the main pages route
Volt::route('/PTEDM', 'p-t-e-d-m.blade.php')
    ->middleware(['auth'])
    ->name('PTEDM');

require __DIR__ . '/auth.php';
