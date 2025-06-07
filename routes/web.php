<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProjectsController;

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
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');;

// For department-specific announcements
Route::get('/{dept}/announcements', [AnnouncementController::class, 'index'])
    ->where('dept', 'computer_science|maths|physics|chemistry');


Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('announcements.update');
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');;

Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{id}', [ProjectsController::class, 'update'])->name('projects.update');
Route::delete('/projects/{id}', [ProjectsController::class, 'destroy'])->name('projects.destroy');