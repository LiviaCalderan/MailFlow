<?php

use App\Http\Controllers\EmailListController;
use App\Http\Controllers\SubscriberController;
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
    Route::get('/email-list/{emailList}/subscriber', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::get('/email-list/{emailList}/subscriber/create', fn() => '')->name('subscribers.create');
    Route::delete('/email-list/{emailList}/subscriber/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
});

require __DIR__.'/settings.php';
