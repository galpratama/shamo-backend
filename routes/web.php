<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyTransactionController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

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

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/details/{slug}', [FrontendController::class, 'details'])->name('details');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    Route::post('/cart/{id}', [FrontendController::class, 'cartAdd'])->name('cart-add');
    Route::delete('/cart/{id}', [FrontendController::class, 'cartDelete'])->name('cart-delete');
    Route::post('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [FrontendController::class, 'success'])->name('checkout-success');


    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('my-transaction', MyTransactionController::class)->only([
            'index', 'show'
        ]);

        Route::middleware(['admin'])->group(function () {
            Route::resource('product', ProductController::class);
            Route::resource('product.gallery', ProductGalleryController::class)->shallow()->only([
                'index', 'create', 'store', 'destroy'
            ]);
            Route::resource('transaction', TransactionController::class)->only([
                'index', 'show', 'edit', 'update'
            ]);
            Route::resource('user', UserController::class)->only([
                'index', 'edit', 'update', 'destroy'
            ]);
        });
    });
});