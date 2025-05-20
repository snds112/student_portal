<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', function () {
   return redirect()->intended("/announcements");
})->name('welcome');
Route::get('/login', function () {
    return view('login');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// For general announcements
Route::get('/announcements', [AnnouncementController::class, 'index']);

// For department-specific announcements
Route::get('/{dept}/announcements', [AnnouncementController::class, 'index'])
    ->where('dept', 'computer_science|maths|physics|chemistry');