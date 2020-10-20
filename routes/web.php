<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/room', function () {
    return view('room');
});

Route::get('/roomCreate', function () {
    return view('roomCreate');
});

Route::get('/roomJoin', function () {
    return view('roomJoin');
});

Route::get('/roomOption', function () {
    return view('roomOption');
});

Route::get('/user', function () {
    return view('user');
});
