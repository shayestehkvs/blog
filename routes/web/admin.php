<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'index']);

Route::get('all-categories', [CategoryController::class, 'allCategories'])->name('all-categories');
Route::get('create-category', [CategoryController::class, 'createCategory'])->name('create-category');
Route::post('store-category', [CategoryController::class, 'storeCategory'])->name('store-category');
Route::get('category-edit/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
Route::put('category-update/{id}', [CategoryController::class, 'updateCategory'])->name('update-category');
Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');

//user management
Route::get('/all-users', [UserController::class, 'allUser'])->name('all-users');
Route::get('create-user', [UserController::class, 'createUser'])->name('create-user');
Route::post('store-user', [UserController::class, 'storeUser'])->name('store-user');
Route::get('edit-user/{id}', [UserController::class, 'editUser'])->name('edit-user');
Route::put('update-user/{id}', [UserController::class, 'updateUser'])->name('update-user');
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete-user');

