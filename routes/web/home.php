<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
    Route::get('user-edit/{id}', [UserController::class, 'editUser'])->name('edit-user');
    Route::put('user-update/{id}', [UserController::class, 'updateUser'])->name('update-user');
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete-user');

});

require __DIR__.'/auth.php';
