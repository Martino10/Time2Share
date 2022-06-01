<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReviewController;

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

Route::middleware(['auth'])->group(function () {
    // user pages
    Route::get('/user/{id}', [UserController::class, 'show'])->name('profile');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('editprofile');
    Route::post('/user/{id}', [UserController::class, 'update'])->name('updateprofile');

    // review pages
    Route::post('/user/{id}/postreview', [ReviewController::class, 'store'])->name('postreview'); 

    // dashboard
    Route::get('/dashboard/{id}', [UserController::class, 'dashboard'])->name('dashboard');

    // product pages
    Route::get('/user/{id}/myproducts', [ProductController::class, 'myproducts'])->name('myproducts');
    Route::get('/user/{id}/browse', [ProductController::class, 'browse'])->name('browseitems');
    Route::get('/user/{id}/addproduct', [ProductController::class, 'addproduct'])->name('addproduct');
    Route::post('/user/{id}/myproducts', [ProductController::class, 'store'])->name('storeproduct');
    Route::get('/product/{product_id}', [ProductController::class, 'viewproduct'])->name('viewproduct');

    // loan pages
    Route::get('/user/{id}/myloans', [LoanController::class, 'myloans'])->name('myloans');
    Route::get('/product/{product_id}/loan', [LoanController::class, 'loanproduct'])->name('loanproduct');
    Route::post('/user/{id}/myloans', [LoanController::class, 'returnloan'])->name('returnloan');
    Route::post('/dashboard/{id}', [LoanController::class, 'endloan'])->name('endloan');
    Route::post('/product/{product_id}', [LoanController::class, 'store'])->name('storeloan');

});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
