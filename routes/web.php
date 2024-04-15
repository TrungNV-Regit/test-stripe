<?php

use App\Http\Controllers\CustomerController;
use App\Services\BalanceService;
use App\Services\StripeService;
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
    return view('welcome');
});

Route::group(['as' => 'balances.', 'prefix' => 'balances'], function () {
    Route::get('/detail', [BalanceService::class, 'detail'])->name('detail');
    Route::get('/transactions', [BalanceService::class, 'getTransactions'])->name('transactions');
});

Route::group(['as' => 'customer.', 'prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::get('/create-session', [CustomerController::class, 'createSession'])->name('create-session');
});

Route::group(['as' => 'services.', 'prefix' => 'services'], function () {
    Route::get('/products', [StripeService::class, 'getProducts'])->name('get-products');
    Route::get('/prices', [StripeService::class, 'getPrices'])->name('get-prices');
    Route::get('/subscriptions', [StripeService::class, 'getSubscriptions'])->name('subscriptions');
    Route::get('/create-subscription', [StripeService::class, 'createSubscription'])->name('create-subscription');
    Route::get('/cancel-subscription', [StripeService::class, 'cancelSubscription'])->name('cancel-subscription');
});
