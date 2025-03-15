<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TextAnalysisController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index']);
Route::get('detail-product/{id}', [HomeController::class, 'detailProduct'])->name('detail.product');


// text analysis
Route::get('/text-analysis', [TextAnalysisController::class, 'index'])->name('text-analysis.index');
Route::post('/text-analysis', [TextAnalysisController::class, 'analyze'])->name('text-analysis.analyze');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('myorder', [OrderController::class, 'myOrders'])->name('myOrders'); 
    Route::post('orders/{order}/canceled', [OrderController::class, 'updateStatusCanceled'])->name('orders.canceled');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', function(){
        return view('backend.page.dashboard', [
            'title' => 'Halaman Dashboard',
        ]);
    })->name('dashboard');   

    // order 
    Route::get('order', [OrderController::class, 'index'])->name('order');    
    Route::post('/orders/{order}/processing', [OrderController::class, 'updateStatusProcessing'])->name('orders.processing');
    Route::post('/orders/{order}/complete', [OrderController::class, 'updateStatusComplete'])->name('orders.complete');

    // product
    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('product/tambah-data', [ProductController::class, 'create'])->name('tambah-data');
    Route::post('product/store', [ProductController::class, 'store'])->name('store');
    Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::patch('product/updateStatus/{id}', [ProductController::class, 'updateStatus'])->name('updateStatus');
    Route::put('product/updateStok/{id}', [ProductController::class, 'updateStok'])->name('updateStok');
    Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');

    // customer 
    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
});
