<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

//normal redirect
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register_teacher', function () {
    return view('auth.registerteacher');
})->name('register_teacher ');

Route::get('/view_profile', 
[   ProfileController::class, 'viewUser'])
->name('view_profile');

Route::get('/update_profile_form', 
[   ProfileController::class, 'update_profile_form'])
->name('update_profile_form');

Route::post('/update_profile_form_post', 
[   ProfileController::class, 'update_profile_form_post'])
->name('update_profile_form_post');

Route::get('/adminteacherLogin', function () {
    return view('auth.teacher.login');
});


Route::get('/adminViewProfile', 
[   ProfileController::class, 'adminViewProfile'])
->name('adminViewProfile');

//adminUpdateProfile

Route::get('/adminUpdateProfile', 
[   ProfileController::class, 'adminUpdateProfile'])
->name('adminUpdateProfile');
//route
//admin_update_profile_form_post

Route::post('/adminupdateprofileformpost', 
[   ProfileController::class, 'adminupdateprofileformpost'])
->name('adminupdateprofileformpost');

// web.php (Routes file)
Route::delete('/deleteUser/{user}', [ProfileController::class, 'destroyProfile'])->name('users.destroy');


Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
