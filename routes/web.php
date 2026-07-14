<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('uk-car-booking');
})->name('home');

Route::get('/uk-about', function () {
    return view('uk-about');
})->name('uk-about');

 Route::get('/uk-terms', function () {
    return view('uk-terms');
})->name('uk-terms');

  Route::get('/uk-privacy', function () {
    return view('uk-privacy');
})->name('uk-privacy');

  Route::get('/uk-contact', function () {
    return view('uk-contact');
})->name('uk-contact');

 Route::get('/uk-global', function () {
    return view('uk-global');
})->name('uk-global');

 Route::get('/operator-signup', function () {
    return view('uk-operator');
})->name('uk-operator');