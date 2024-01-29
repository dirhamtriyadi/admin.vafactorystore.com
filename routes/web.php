<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PrintTypeController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\CashFlowController;
use App\Http\Controllers\CashFlowStatementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionReportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderTransactionController;
use App\Http\Controllers\OrderTrackingController;

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

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('templates.main');
    });

    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('payment-method', PaymentMethodController::class);
    Route::resource('print-type', PrintTypeController::class);
    Route::resource('tracking', TrackingController::class);
    Route::resource('cash-flow', CashFlowController::class);
    Route::resource('cash-flow-statement', CashFlowStatementController::class);
    Route::resource('product', ProductController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('transaction-report', TransactionReportController::class);
    Route::resource('order', OrderController::class);
    Route::resource('order-transaction', OrderTransactionController::class);
    Route::resource('order-tracking', OrderTrackingController::class);
});
