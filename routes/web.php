<?php

use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController as FProductController;
use App\Http\Controllers\Frontend\SslCommerzPaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



//frontend routes
Route::get('/', [FrontendHomeController::class, 'home'])->name('home');

Route::get('/product/view/{id}', [FProductController::class, 'view'])->name('product.view');
Route::get('/all-products', [FProductController::class, 'list'])->name('all.products');

Route::post('/customer-login', [CustomerController::class, 'login'])->name('customer.login');

Route::get('/show-registration', [CustomerController::class, 'registrationForm'])->name('customer.registration');

Route::post('/customer-registration', [CustomerController::class, 'registration'])->name('customer.registration.store');



Route::get('/add-to-cart/{p_id}', [OrderController::class, 'addToCart'])->name('add.to.cart');

Route::get('/cart/view', [OrderController::class, 'viewCart'])->name('cart.view');


Route::group(['middleware' => 'customerAuth'], function () {

        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

        Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
});


//ssl commerz
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END



//admin panel routes
Route::group(['prefix' => 'admin'], function () {

        Route::get('/login', [UserController::class, 'login'])->name('login');
        Route::post('/do-login', [UserController::class, 'doLogin'])->name('admin.dologin');

        Route::group(['middleware' => 'auth'], function () {

                Route::get('/', [HomeController::class, 'home'])->name('dashboard');

                Route::get('/categories', [CategoryController::class, 'categories'])->name('category.list');

                Route::get('/products', [ProductController::class, 'products'])->name('product.list');
                Route::get('/product/create', [ProductController::class, 'productCreate'])->name('product.create.form');
                Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

                Route::get('/brand', [BrandController::class, 'brand']);

                Route::get('/create-category', [CategoryController::class, 'createCategory'])->name('category.create');

                Route::post('/category-store', [CategoryController::class, 'categoryStore'])->name('category.store');

                Route::get('/signout', [UserController::class, 'signout'])->name('admin.signout');
                Route::get('/order-list', [BackendOrderController::class, 'orders'])->name('order.list');


        });
});
