<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('/cat/posts', 'CategoryController@categoryPosts')->name('category.posts');
Route::resource('/role', 'RoleController');
Route::resource('/permission', 'PermissionController');
Route::resource('/user', 'UserController');
Route::resource('/category', 'CategoryController');
Route::resource('/post', 'PostController');
Route::resource('/comment', 'CommentController');
