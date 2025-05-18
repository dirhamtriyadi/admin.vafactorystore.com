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
use App\Http\Controllers\CashFlowReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionReportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderTransactionController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MakloonController;
use App\Http\Controllers\MakloonTransactionController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\RawMaterialInController;
use App\Http\Controllers\RawMaterialOutController;

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
    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('dashboard', DashboardController::class);
    Route::get('user/get-user-data-table', [UserController::class, 'getUserDataTable'])->name('user.get-user-data-table');
    Route::resource('user', UserController::class);
    Route::get('role/get-role-data-table', [RoleController::class, 'getRoleDataTable'])->name('role.get-role-data-table');
    Route::resource('role', RoleController::class);
    Route::get('customer/get-customer-data-table', [CustomerController::class, 'getCustomerDataTable'])->name('customer.get-customer-data-table');
    Route::resource('customer', CustomerController::class);
    Route::get('payment-method/get-customer-data-table', [PaymentMethodController::class, 'getPaymentMethodDataTable'])->name('payment-method.get-customer-data-table');
    Route::resource('payment-method', PaymentMethodController::class);
    Route::get('print-type/get-customer-data-table', [PrintTypeController::class, 'getPrintTypeDataTable'])->name('print-type.get-customer-data-table');
    Route::resource('print-type', PrintTypeController::class);
    Route::get('tracking/get-customer-data-table', [TrackingController::class, 'getTrackingDataTable'])->name('tracking.get-customer-data-table');
    Route::resource('tracking', TrackingController::class);
    Route::resource('cash-flow', CashFlowController::class);
    Route::get('cash-flow-report/print', [CashFlowReportController::class, 'print'])->name('cash-flow-report.print');
    Route::resource('cash-flow-report', CashFlowReportController::class);
    Route::get('product/get-product-data-table', [ProductController::class, 'getProductDataTable'])->name('product.get-product-data-table');
    Route::resource('product', ProductController::class);
    Route::resource('transaction', TransactionController::class);
    Route::get('transaction-report/print', [TransactionReportController::class, 'print'])->name('transaction-report.print');
    Route::resource('transaction-report', TransactionReportController::class);
    Route::resource('order', OrderController::class);
    Route::resource('order-transaction', OrderTransactionController::class);
    Route::resource('order-tracking', OrderTrackingController::class);
    Route::put('profile/{id}/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('makloon/print', [MakloonController::class, 'print'])->name('makloon.print');
    Route::resource('makloon', MakloonController::class);
    Route::resource('makloon-transaction', MakloonTransactionController::class);
    Route::get('raw-material/get-raw-material-data-table', [RawMaterialController::class, 'getRawMaterialDataTable'])->name('raw-material.get-raw-material-data-table');
    Route::resource('raw-material', RawMaterialController::class);
    Route::get('raw-material-in/get-raw-material-in-data-table', [RawMaterialInController::class, 'getRawMaterialInDataTable'])->name('raw-material-in.get-raw-material-in-data-table');
    Route::resource('raw-material-in', RawMaterialInController::class);
    Route::resource('raw-material-out', RawMaterialOutController::class);
    Route::resource('profile', ProfileController::class);
});
