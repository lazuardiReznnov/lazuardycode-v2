<?php

use App\Http\Controllers\Dashboard\Customer\DashboardCustomerController;
use App\Http\Controllers\Dashboard\Fintech\DashboardFintechController;
use App\Http\Controllers\Dashboard\Product\DashboardCategoryProductController;
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

Route::controller(DashboardFintechController::class)->group(function () {
    Route::get('/dashboard/fintech/acountfintech/checkSlug', 'cardcheckSlug');
    Route::get('/dashboard/fintech/checkSlug', 'checkSlug');
    Route::get('/dashboard/fintech/acountfintech/{fintech}', 'createcard');
    Route::post('/dashboard/fintech/acountfintech', 'storecard');
    Route::get(
        '/dashboard/fintech/acountfintech/{acountFintech}/edit',
        'editcard'
    );
    Route::put(
        '/dashboard/fintech/acountfintech/{acountFintech}',
        'updatecard'
    );

    Route::delete(
        '/dashboard/fintech/acountfintech/{acountFintech}',
        'carddestroy'
    );
});
Route::resource('/dashboard/fintech', DashboardFintechController::class);
