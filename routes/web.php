<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WishlistsController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\StudentAuth;
use App\Http\Middleware\EitherAdminOrStudent;

Route::get('/', function () {
   return redirect()->intended("/announcements");
})->name('welcome');
Route::get('/login', function () {
    return view('login');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(EitherAdminOrStudent::class);



Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index')->middleware();

Route::get('/{dept}/announcements', [AnnouncementController::class, 'index'])
    ->where('dept', 'computer_science|maths|physics|chemistry');


Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create')->middleware(AdminAuth::class);
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store')->middleware(AdminAuth::class);
Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit')->middleware(AdminAuth::class);
Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('announcements.update')->middleware(AdminAuth::class);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy')->middleware(AdminAuth::class);

Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index')->middleware(AdminAuth::class);

Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create')->middleware(AdminAuth::class);
Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store')->middleware(AdminAuth::class);
Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit'])->name('projects.edit')->middleware(AdminAuth::class);
Route::put('/projects/{id}', [ProjectsController::class, 'update'])->name('projects.update')->middleware(AdminAuth::class);
Route::delete('/projects/{id}', [ProjectsController::class, 'destroy'])->name('projects.destroy')->middleware(AdminAuth::class);


Route::get('/account/wish-list', [WishlistsController::class, 'index'])->name('wishlists.index')->middleware(StudentAuth::class);
Route::get('/account/wish-list/edit', [WishlistsController::class, 'edit'])->name('wishlists.edit')->middleware(StudentAuth::class);
Route::post('/account/wish-list', [WishlistsController::class, 'update'])->name('wishlists.update')->middleware(StudentAuth::class);

Route::get('/account', [StudentController::class, 'index'])->name('student.index')->middleware(StudentAuth::class);

Route::get('/students', [StudentController::class, 'list_students'])->name('student.list')->middleware(AdminAuth::class);
Route::get('/students/{id}', [StudentController::class, 'single_student'])->name('student.single')->middleware(AdminAuth::class);