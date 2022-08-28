<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\web\HomeController::class, 'index'])->name('home');

Route::get('/posts-by-category/{category}', [App\Http\Controllers\web\HomeController::class, 'postsByCategory'])->name('postsByCategory');

Route::get('/single-post/{post}', [App\Http\Controllers\web\HomeController::class, 'singlePost'])->name('singlePost');

Route::post('/add-post-comment/{post}', [App\Http\Controllers\web\HomeController::class, 'addPostComment'])->name('addPostComment')->middleware('auth');

