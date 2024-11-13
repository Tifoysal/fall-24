<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home']);

Route::get('/categories',[CategoryController::class,'categories']);


Route::get('/products',[ProductController::class,'products']);

Route::get('/brand',[BrandController::class,'brand']);

Route::get('/create-category',[CategoryController::class,'createCategory']);

Route::post('/category-store',[CategoryController::class,'categoryStore']);