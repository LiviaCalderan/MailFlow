<?php

use App\Http\Controllers\EmailListController;
use Illuminate\Support\Facades\Route;

Route::get('/',  function() {
    Auth::loginUsingId(1);

    return to_route('dashboard');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Email List
    Route::get('/email-list', [EmailListController::class, 'index'])->name('email-list.index');
    Route::get('/email-list/create', [EmailListController::class, 'create'])->name('email-list.create');
    Route::post('/email-list/store', [EmailListController::class, 'store'])->name('email-list.store');
});

require __DIR__.'/settings.php';
