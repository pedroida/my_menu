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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    /** Profile */
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::put('profile', 'ProfileController@update')->name('profile.update');

    Route::resources([
        'categories' => \App\Http\Controllers\CategoryController::class,
        'units' => \App\Http\Controllers\UnitController::class
    ]);


    Route::get('pagination/categories', [\App\Http\Controllers\CategoryController::class, 'pagination'])->name('pagination.categories');
    Route::get('pagination/units', [\App\Http\Controllers\UnitController::class, 'pagination'])->name('pagination.units');
});