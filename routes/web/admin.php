<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

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

//permissions managment
Route::get('/all-permissions', [PermissionController::class, 'allPermission'])->name('all-permissions');
Route::get('create-permissions', [PermissionController::class, 'createPermission'])->name('create-permission');
Route::post('store-permissions', [PermissionController::class, 'storePermission'])->name('store-permission');
Route::get('edit-permissions/{id}', [PermissionController::class, 'editPermission'])->name('edit-permission');
Route::put('update-permissions/{id}', [PermissionController::class, 'updatePermission'])->name('update-permission');
Route::delete('/delete-permission/{id}', [PermissionController::class, 'deletePermission'])->name('delete-permission');

//roles managment
Route::get('/all-roles', [RoleController::class, 'allRole'])->name('all-roles');
Route::get('create-roles', [RoleController::class, 'createRole'])->name('create-role');
Route::post('store-roles', [RoleController::class, 'storeRole'])->name('store-role');
Route::get('edit-roles/{id}', [RoleController::class, 'editRole'])->name('edit-role');
Route::put('update-roles/{id}', [RoleController::class, 'updateRole'])->name('update-role');
Route::delete('/delete-roles/{id}', [RoleController::class, 'deleteRole'])->name('delete-role');
