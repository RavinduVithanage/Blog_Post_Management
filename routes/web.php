<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/posts',[PostController::class,'index']);
// Route::get('post/create',[PostController::class,'create']);
// Route::post('/posts',[PostController::class,'store']);
// Route::get('/posts/{id}',[PostController::class,'show']);
// Route::get('/posts/{id}/edit',[PostController::class,'edit']);
// Route::put('/posts/{id}',[PostController::class,'update']);
// Route::delete('/posts/{id}',[PostController::class,'destroy']);

Route::resource('/posts', PostController::class);
Route::get('/register',[UserRegisterController::class,'register'])->name('register');
Route::post('/user-register',[UserRegisterController::class,'userRegister'])->name('register.user');
Route::get('/login',[UserLoginController::class,'loginUser'])->name('login');
Route::post('/user-login',[UserLoginController::class,'loggedUser'])->name('login.user');
Route::post('/logout',[UserLoginController::class,'logoutUser'])->name('logout.user');