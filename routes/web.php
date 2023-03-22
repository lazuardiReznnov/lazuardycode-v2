<?php

use App\Http\Controllers\Dashboard\Customer\DashboardCustomerController;
use App\Http\Controllers\Dashboard\Product\DashboardCategoryProductController;
use App\Http\Controllers\Dashboard\Product\DashboardPricingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Product\DashboardProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('dashboard');
Route::controller(DashboardCategoryProductController::class)->group(
    function () {
        Route::get('/dashboard/product/CategoryProduct/checkSlug', 'checkSlug');
    }
);

Route::resource(
    '/dashboard/product/CategoryProduct',
    DashboardCategoryProductController::class
)->except('show');

Route::controller(DashboardProductController::class)->group(function () {
    Route::get('/dashboard/product/image/{product}', 'createimage');
    Route::post('/dashboard/product/image/', 'storeimage');
    Route::delete('/dashboard/product/image/{product}', 'destroyimage');
    Route::get('/dashboard/product/checkSlug', 'checkSlug');
    Route::get('/dashboard/product/pricing/{product}', 'pricingcreate');
    Route::put('/dashboard/product/pricing/{product}', 'pricingstore');
});

Route::resource('dashboard/product', DashboardProductController::class);

Route::controller(DashboardCustomerController::class)->group(function () {
    Route::get('/dashboard/customer/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/customer', DashboardCustomerController::class);
