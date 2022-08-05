<?php
use App\Http\Controllers\adminController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\fileController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserNotificationController;
use App\Models\Admin;
use App\Models\payment;
use App\Models\User;
use App\Notifications\PaymentProofUploaded;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth','request'])->name('dashboard');

require __DIR__.'/auth.php';
        
    // Admin Auth Routes
    Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
        Route::namespace('Auth')->middleware('guest:admin')->group(function(){
            // login route
            Route::get('login','AuthenticatedSessionController@create')->name('login');
            Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
        });
        Route::middleware('admin')->group(function(){
            Route::get('dashboard','HomeController@index')->name('dashboard');

        });
        Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
    });

    Route::middleware('admin')->group(function () {
        Route::delete('/customers/delete/{id}',[customerController::class,'delete'])->name('customers.delete');
        Route::put('/customers/formStatus/{id}',[customerController::class,'formStatus'])->name('customers.formStatus');
        Route::get('/customers/list',[customerController::class,'list'])->name('customers.list');
        Route::resource("customers",'customerController');
        Route::resource("admins", 'adminController');

        //Routes For Admin Side Notifications
        
        Route::get('/markasred/{id}',[AdminNotificationController::class,'markasred'])->name('markasred');
        Route::get('/redall',[AdminNotificationController::class,'redall'])->name('redall');
        Route::get('/admin/notifications',[AdminNotificationController::class,'notifications'])->name('paymentNotifications');
        
        //Payments routes for admin side payment actions 
        
        Route::get('payments/pending',[PaymentController::class,'pending'])->name('payments.pending');
        Route::get('payments/approved',[PaymentController::class,'approved'])->name('payments.approved');
        Route::get('/payment/is_approved/{id}',[PaymentController::class,'is_approved'])->name('payments.is_approved');
    });

    //Route for  Customer Profile

    Route::middleware('auth')->group(function(){

        //Routes FOr the customer and invoice controller

        Route::get('/profile',[customerController::class,'profile'])->name('profile');
        Route::post('/customers/store1/{id}',[customerController::class,'store1'])->name('customers.store1');
        Route::get("user_invoices",'invoiceController@user_invoices')->name('user_invoices');
        Route::get("show_user_invoice/{id}",'invoiceController@show_user_invoice')->name('show_user_invoice');

        //Routes For User Side Notificaitons

        Route::get('user/markasred/{id}',[UserNotificationController::class,'markasred'])->name('user.markasred');
        Route::get('user/redall',[UserNotificationController::class,'redall'])->name('user.redall');
        Route::get('user/admin/notifications',[UserNotificationController::class,'notifications'])->name('user.paymentNotifications');

        //Routes for customer sides payment actions
        Route::match(['get','post'],'/payment/create/{id}',[PaymentController::class,'create1'])->name('payments.create1');
        Route::get('/payment',[PaymentController::class,'index'])->name('pays.index');
        Route::post('/payment/store/{id}',[PaymentController::class,'store'])->name('pays.store');
        Route::get('/payments/download/{id}',[PaymentController::class,'download'])->name('payments.download');
        Route::get('/payment/show/{payment}',[PaymentController::class,'show'])->name('payment.show');

    });
    
    Route::get('/invoices/download/{id}',[invoiceController::class,'download'])->name('invoices.download');
    Route::match(['get','post'],'invoices/upload',[invoiceController::class,'upload'])->name('invoices.upload');
    Route::match(['get','post'],'invoices',[invoiceController::class,'index'])->name('invoices.index');
    Route::post('invoices/filters',[invoiceController::class,'filters'])->name('invoices.filters');
    Route::get('invoices',[invoiceController::class,'index'])->name('invoices.index');
    Route::get('invoices/create',[invoiceController::class,'create'])->name('invoices.create');
    Route::post('store',[invoiceController::class,'store'])->name('invoices.store');
    Route::get('invoices/show/{id}',[invoiceController::class,'show'])->name('invoices.show');
    Route::get('invoices/edit/{id}',[invoiceController::class,'edit'])->name('invoices.edit');
    Route::put('update',[invoiceController::class,'update'])->name('invoices.update');
    Route::delete('destroy',[invoiceController::class,'destroy'])->name('invoices.destroy');
    Route::match(['get','post'],'/bulk-invoices',[fileController::class,'bulkInvoices'])->name('bulk-invoices');
    Route::post('invoice/bulkUpload',[fileController::class,'bulkUpload'])->name('invoices.bulkUpload');
    Route::resource('files','fileController');


    //Routes For The Delivery Orders
    Route::get('/deliveryOrders/upload',[DeliveryOrderController::class,'upload'])->name('deliveryOrder.upload');
    Route::post('/deliveryOrders/upload1',[DeliveryOrderController::class,'upload1'])->name('deliveryOrder.upload1');
    Route::get('/deliveryOrders/bulkUpload',[DeliveryOrderController::class,'bulkUpload'])->name('deliveryOrder.bulkUpload');
    Route::get('/deliveryOrders/download/{id}',[DeliveryOrderController::class,'download'])->name('deliveryOrder.download');
    Route::resource('deliveryOrders','DeliveryOrderController');
   











