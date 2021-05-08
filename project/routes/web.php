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

Route::get('/', [\App\Http\Controllers\MenuController::class, '__invoke']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\StoreController::class, 'index'])->name('home');

Route::get('product/{product}/thumbnail', [\App\Http\Controllers\ProductController::class, 'getThumb'])->name('product.thumb');
Route::get('store/banner', [\App\Http\Controllers\StoreController::class, 'getBanner'])->name('store.banner');

Route::get('store/categories', [\App\Http\Controllers\StoreController::class, 'getCategories'])->name('store.categories');

Route::get('store/menu/products', [\App\Http\Controllers\StoreController::class, 'pagination'])->name('store.menu.pagination');

Route::middleware(['auth'])->group(function () {
    /** Profile */
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::put('profile', 'ProfileController@update')->name('profile.update');

    Route::resources([
        'categories' => \App\Http\Controllers\CategoryController::class,
        'units' => \App\Http\Controllers\UnitController::class,
        'users' => \App\Http\Controllers\UserController::class,
        'products' => \App\Http\Controllers\ProductController::class,
        'promotions' => \App\Http\Controllers\PromotionController::class,
    ]);

    Route::post('store/whatsapp', [\App\Http\Controllers\StoreController::class, 'updateWhatsapp'])->name('whatsapp.update');
    Route::post('banner/update', [\App\Http\Controllers\StoreController::class, 'bannerUpdate'])->name('banner.update');


    Route::get('pagination/categories', [\App\Http\Controllers\CategoryController::class, 'pagination'])->name('pagination.categories');
    Route::get('pagination/units', [\App\Http\Controllers\UnitController::class, 'pagination'])->name('pagination.units');
    Route::get('pagination/users', [\App\Http\Controllers\UserController::class, 'pagination'])->name('pagination.users');
    Route::get('pagination/products', [\App\Http\Controllers\ProductController::class, 'pagination'])->name('pagination.products');
    Route::get('pagination/promotions', [\App\Http\Controllers\PromotionController::class, 'pagination'])->name('pagination.promotions');
});