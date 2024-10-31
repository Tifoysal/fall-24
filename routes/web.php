<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home']);
Route::get('contact-us',[ContactUsController::class,'showContactUs']);

Route::get('about-us',[HomeController::class,'aboutUs']);