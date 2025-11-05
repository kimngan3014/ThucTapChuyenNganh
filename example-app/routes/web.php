<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/add_to_wishlist', function () {
    return view('add_to_wishlist');
})->name('add_to_wishlist');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/men', function () {
    return view('men');
})->name('men');

Route::get('/order', function () {
    return view('order');
})->name('order');

Route::get('/women', function () {
    return view('women');
})->name('women');