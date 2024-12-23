<?php

use Illuminate\Support\Facades\Route;

Route::middleware('check.gate.token')->group(function () {
    Route::middleware(['check.pro.member', 'header.data'])->group(function () {
        Route::get('/cart', function() {
            return view('front.dabory.pro.shop-1.cart');
        })->name('cart');
    });
});
