<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/free-register-form', function () {
    return view('free-register-form');
});

Route::get('/userlogin/login', function () {
    return view('userlogin.login');
});