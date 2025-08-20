<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/post/{id}', [HomeController::class, 'show'])->name('post.show');

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
       Route::middleware('role:Super-Admin')->group(function () {
              Route::resource('users', UserController::class)->except(['create', 'show']);
       });
       Route::group(['middleware' => ['role:Super-Admin|writer']], function () {
              Route::resource('posts', PostController::class)->except(['create', 'show']);
       });

       Route::post('comments/{postid}', [HomeController::class, 'storeComment'])->name('comments.store');

       Route::resource('permissions', PermissionController::class)->except(['create', 'show']);
       Route::resource('roles', RoleController::class)->except(['create', 'show']);
});