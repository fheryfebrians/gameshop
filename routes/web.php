<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AdminController;
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

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});

//Route::get('/register', function () {
//    return view('login');
//});

Route::post("/login",[UserController::class,'login']);
Route::post("/register",[UserController::class,'register']);
Route::view('register','register');

Route::get("/",[ProductController::class,'index']);
Route::get("detail/{id}",[ProductController::class,'detail'])->name('product.detail');
Route::get("search",[ProductController::class,'search']);

Route::middleware('user')->group(function() {
    Route::post("add_to_cart",[ProductController::class,'addToCart']);
    Route::get("cartlist",[ProductController::class,'cartList']);
    Route::get("removecart/{id}",[ProductController::class,'removeCart']);
    Route::get("ordernow",[ProductController::class,'orderNow']);
    Route::post("orderplace",[ProductController::class,'orderplace']);
    Route::get("myorders",[ProductController::class,'myOrders']);
    Route::view('upload', 'upload');
    Route::post('upload',[ProductController::class,'upload']);

    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::resource('products', ProductController::class);
    Route::post('/upload', 'ProductController@store')->name('product.store');
    Route::post('/storeOrder', [ProductController::class, 'storeOrder']);
});

Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('/transaction', [AdminController::class, 'transaction']);
    Route::get('/transaction/{id}', [AdminController::class, 'editTransaction'])->name('transaction.edit');
    Route::put('/transaction/{id}', [AdminController::class, 'updateTransaction'])->name('transaction.update');
});
