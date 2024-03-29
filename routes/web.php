<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Fintech\DashboardFintechController;
use App\Http\Controllers\Dashboard\Product\DashboardProductController;
use App\Http\Controllers\Dashboard\Transaction\DashboardFeeController;
use App\Http\Controllers\Dashboard\Transaction\DashboardDebtController;
use App\Http\Controllers\Dashboard\Customer\DashboardCustomerController;
use App\Http\Controllers\Dashboard\Transaction\DashboardAcountController;
use App\Http\Controllers\Dashboard\Marketing\DashboardMarketingController;
use App\Http\Controllers\Dashboard\Transaction\DashboardCashflowController;
use App\Http\Controllers\Dashboard\Transaction\DashboardSchaduleController;
use App\Http\Controllers\Dashboard\Product\DashboardCategoryProductController;
use App\Http\Controllers\Dashboard\Transaction\DashboardTransactionController;

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
    return view('auth.login');
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
    Route::get('/dashboard/product/upload-excel', 'uploadexcel');
    Route::post('/dashboard/product/store-excel', 'storeexcel');
});

Route::resource('dashboard/product', DashboardProductController::class);

Route::controller(DashboardCustomerController::class)->group(function () {
    Route::get('/dashboard/customer/checkSlug', 'checkSlug');
    Route::delete('/dashboard/customer/image/{customer}', 'destroyimage');
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

Route::controller(DashboardMarketingController::class)->group(function () {
    Route::get('/dashboard/marketing/checkSlug', 'checkSlug');
    Route::delete('/dashboard/marketing/image/{marketing}', 'destroyimage');
});

Route::resource('/dashboard/marketing', DashboardMarketingController::class);

Route::controller(DashboardAcountController::class)->group(function () {
    Route::get('/dashboard/transaction/cashflow/acount/checkSlug', 'checkSlug');
});

Route::resource(
    '/dashboard/transaction/cashflow/acount',
    DashboardAcountController::class
);

Route::controller(DashboardCashflowController::class)->group(function () {
    Route::get('/dashboard/transaction/cashflow/create-out', 'createout');
});

Route::resource(
    '/dashboard/transaction/cashflow',
    DashboardCashflowController::class
);

Route::controller(DashboardDebtController::class)->group(function () {
    Route::get('/dashboard/transaction/debt/checkSlug', 'checkSlug');
});

Route::controller(DashboardSchaduleController::class)->group(function () {
    Route::get('/dashboard/transaction/debt/schadule/{debt}', 'addschadule');
    Route::post('/dashboard/transaction/debt/schadule', 'storeschadule');
    Route::get(
        '/dashboard/transaction/debt/schadule/editstate/{schadule}',
        'editstate'
    );
    Route::put(
        '/dashboard/transaction/debt/schadule/updatestate/{schadule}',
        'updatestate'
    );
    Route::get(
        '/dashboard/transaction/debt/schadule/{schadule}/edit',
        'editschadule'
    );
    Route::put(
        '/dashboard/transaction/debt/schadule/{schadule}',
        'updateschadule'
    );
});

Route::controller(DashboardDebtController::class)->group(function () {
    Route::get('/dashboard/transaction/debt/checkSlug', 'checkSlug');
    Route::get('/dashboard/transaction/debt/getacount', 'getacount');
});

Route::resource('/dashboard/transaction/debt', DashboardDebtController::class);

Route::controller(DashboardTransactionController::class)->group(function () {
    Route::get('/dashboard/transaction/checkSlug', 'checkSlug');
    Route::get('/dashboard/transaction/getproduct', 'getproduct');
    Route::get('/dashboard/transaction/getamount', 'getamount');
});

Route::controller(DashboardFeeController::class)->group(function () {
    Route::get('/dashboard/transaction/fee', 'index');
});

Route::resource(
    '/dashboard/transaction',
    DashboardTransactionController::class
);
