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

Route::get('/', function () { //esta es la estructura base, guiense con esto para traer los htmls
    return view('welcome');
});

// CRISS ----------------------------------------------------------------------------------------

Route::get('/hola', function () {
    return view('hola');
});

// -----------------------------------------------------------------------------------
