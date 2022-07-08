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

Route::get('/page-2', 'App\Http\Controllers\Page2Controller')->name('page-2')->middleware(['auth']);
Route::get('/', 'App\Http\Controllers\HomeController')->name('home')->middleware(['auth']);
