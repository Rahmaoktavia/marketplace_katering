<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MerchantDashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerDashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Registrasi dan login hanya untuk pengguna yang belum login.
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterChoice'])->name('register');
    Route::get('/register/merchant', [AuthController::class, 'showRegisterMerchant'])->name('register.merchant');
    Route::get('/register/customer', [AuthController::class, 'showRegisterCustomer'])->name('register.customer');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

// Logout hanya untuk pengguna yang sudah login.
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Halaman khusus Merchant.
Route::middleware(['auth', 'role:merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/dashboard', [MerchantDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [MerchantController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [MerchantController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [MerchantController::class, 'update'])->name('profile.update');

    Route::resource('categories', MenuCategoryController::class)->except(['show']);

    Route::resource('menus', MenuController::class)->except(['show']);

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
});

// Halaman khusus Customer.
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/caterings', [CateringController::class, 'index'])->name('caterings.index');

    Route::get('/checkout/{menu}', [OrderController::class, 'customerCheckout'])->name('checkout.create');
    Route::post('/checkout/{menu}', [OrderController::class, 'customerCheckoutStore'])->name('checkout.store');

    Route::get('/orders', [OrderController::class, 'customerCheckoutIndex'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'customerCheckoutShow'])->name('orders.show');

    Route::post('/payment/{order}/pay', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/{order}', [PaymentController::class, 'checkout'])->name('payment.index');
    Route::get('/payment/{order}/success', [PaymentController::class, 'success'])->name('payment.success');

    Route::get('/invoices/{invoice}', [InvoiceController::class, 'customerShow'])->name('invoices.show');

    Route::get('/profile', [CustomerController::class, 'index'])->name('profile.index');

    Route::put('/profile', [CustomerController::class, 'update'])->name('profile.update');

});

Route::post('/midtrans/notification', [PaymentController::class, 'notification'])->name('midtrans.notification');
