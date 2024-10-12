<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::view('/','welcome');

Route::get('/app',Home::class)->name('app')->middleware(['auth']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
