<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestHomeController::class, 'index'])->name('home');
