<?php

use App\Http\Controllers\PostController;
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