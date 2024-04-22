<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {

    if(Gate::allows('delete-user')){
        return view('welcome');

    } else {
        dd('no');
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
Route::get('product-detail/{id}', [HomeController::class, 'productDetail'])->name('product-detail');
Route::post('add-card/{id}', [HomeController::class, 'addToCard'])->name('add-card');
Route::get('show-cart', [HomeController::class, 'showCart'])->name('show-cart');
Route::get('cash-order', [HomeController::class, 'cashOrder'])->name('cash-order');
Route::delete('/remove-cart-item/{id}', [HomeController::class, 'removeItemFromCart'])->name('remove-cart-item');

require __DIR__ . '/../auth.php';
