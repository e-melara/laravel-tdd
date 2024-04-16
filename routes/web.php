<?php

use App\Http\Controllers\StatusesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('statuses', [
    StatusesController::class, 'store',
])->name('statuses.store')->middleware('auth');

Auth::routes();
