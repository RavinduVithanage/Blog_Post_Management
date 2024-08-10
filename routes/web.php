<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/posts',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/{post}',[PostController::class,'show'])->middleware('can-view-post')->name('posts.show');
// Route::resource('/posts', PostController::class);

Route::middleware('auth')->group(function () { 
    Route::get('post/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/posts',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');
    Route::post('/logout',[UserLoginController::class,'logoutUser'])->name('logout.user');

    Route::get('/admin', function () {
        return 'Your Logged in admin';
    })->middleware('can:is_admin')->name('admin');

});

Route::middleware('guest')->group(function () {
    Route::get('/register',[UserRegisterController::class,'register'])->name('register');
    Route::post('/user-register',[UserRegisterController::class,'userRegister'])->name('register.user');
    Route::get('/login',[UserLoginController::class,'loginUser'])->name('login');
    Route::post('/user-login',[UserLoginController::class,'loggedUser'])->name('login.user');
});

