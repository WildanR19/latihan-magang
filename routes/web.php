<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{id}', [HomeController::class, 'show'])->name('post.show');

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
       Route::resource('users', UserController::class)->except(['create', 'show']);
       Route::resource('posts', PostController::class)->except(['create', 'show']);
});