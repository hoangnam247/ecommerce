<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\client\PersonalController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\StaffController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\SizeController;




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
//client

Route::get('/', [MainController::class,'index'])->name('home');

Route::get('/login', [AuthController::class,'getLogin'])->name('login');
Route::post('/login', [AuthController::class,'postLogin']);

Route::get('/forgot', [AuthController::class,'getForgot'])->name('forgot');
Route::post('/forgot', [AuthController::class,'postForgot']);

Route::get('/register', [AuthController::class,'getRegister'])->name('register');
Route::post('/register', [AuthController::class,'postRegister']);



Route::get('/logout', [AuthController::class,'getLogout'])->name('logout');

Route::middleware('auth.user')->group(function(){
//đổi mật khẩu
Route::get('/change-pass', [AuthController::class,'getChangePass'])->name('changepass');
Route::post('/change-pass', [AuthController::class,'postChangePass']);
//giỏ hàng
Route::get('/cart', [CartController::class,'getCart'])->name('cart');
Route::post('/postCart', [CartController::class, 'postCart'])->name('cart.add');
Route::post('/updateCart', [CartController::class, 'updateCart'])->name('updateCart');
Route::get('/delete/{id}', [CartController::class,'getDelete'])->name('deletecart');
Route::get('/payment', [CartController::class,'getPayment'])->name('payment');
Route::post('/payment', [CartController::class,'postPayment'])->name('postPayment');
//thông tin cá nhân 
Route::post('/updatePersonal/{id}', [PersonalController::class,'updatePersonal'])->name('updatePersonal');
Route::get('/personal', [PersonalController::class,'getPersonal'])->name('personal');
Route::get('/detail-invoice/{id}', [PersonalController::class,'getDetailInvoice'])->name('detailinvoice');
});




Route::get('/detail-product/{id}', [ProductController::class,'getDetailProduct'])->name('getdetail-product');
Route::post('/detail-product/{id}', [ProductController::class, 'getPrice'])->name('detail-product');

Route::get('/collections/all', [ProductController::class,'getCollections'])->name('collections');
Route::get('/collections/{id}', [ProductController::class,'getCollectionsByCategory'])->name('collectionsbycategory');






 //admin 
 Route::middleware('auth.user')->prefix('admin/product')->group(function(){
    Route::get('/', [ProductController::class,'getProduct'])->name('product');
    Route::get('/add', [ProductController::class,'getAdd'])->name('getaddProduct');
    Route::post('/add', [ProductController::class, 'postAdd']);
    Route::get('/edit/{id}', [ProductController::class,'getEdit'])->name('editProduct');
    Route::post('/edit/{id}', [ProductController::class,'postEdit']);
    Route::get('/detail/{id}', [ProductController::class,'getDetail'])->name('detailProduct');
    Route::post('/detail/{id}', [ProductController::class,'postDetail']);
    Route::get('/delete/{id}', [ProductController::class,'getDelete'])->name('deleteProduct');
    Route::get('/edit-status/{id}', [ProductController::class,'getEditStatus'])->name('editstatusproduct');
    Route::post('/edit-status/{id}', [ProductController::class,'postEditStatus']);


});

Route::middleware('auth.admin')->prefix('admin/category')->group(function(){
    Route::get('/', [CategoryController::class,'getCategory'])->name('category');
    Route::get('/add', [CategoryController::class,'getAdd'])->name('addCategory');
    Route::post('/add', [CategoryController::class, 'postAdd']);
    Route::get('/edit/{id}', [CategoryController::class,'getEdit'])->name('editCategory');
    Route::post('/edit/{id}', [CategoryController::class,'postEdit']);
    Route::get('/delete/{id}', [CategoryController::class,'getDelete'])->name('deleteCategory');
  
});

Route::middleware('auth.admin')->prefix('admin/size')->group(function(){
    Route::get('/', [SizeController::class,'getSize'])->name('size');
    Route::get('/add', [SizeController::class,'getAdd'])->name('addSize');
    Route::post('/add', [SizeController::class, 'postAdd']);
    Route::get('/edit/{id}', [SizeController::class,'getEdit'])->name('editSize');
    Route::post('/edit/{id}', [SizeController::class,'postEdit']);
  
});
Route::middleware('auth.admin')->prefix('admin/staff')->group(function(){
    Route::get('/', [StaffController::class,'getStaff'])->name('staff');
    Route::get('/add', [StaffController::class,'getAdd'])->name('addStaff');
    Route::post('/add', [StaffController::class, 'postAdd']);
    Route::get('/edit/{id}', [StaffController::class,'getEdit'])->name('editStaff');
    Route::post('/edit/{id}', [StaffController::class,'postEdit']);
    Route::get('/delete/{id}', [StaffController::class,'getDelete'])->name('deleteStaff');
});

//baloi
Route::middleware('auth.admin')->prefix('admin/customer')->group(function(){
    Route::get('/', [CustomerController::class,'getCustomer'])->name('customer');
    Route::get('/delete/{id}', [CustomerController::class,'getDelete'])->name('deleteCustomer');
    Route::get('/edit-status/{id}', [CustomerController::class,'getEditStatus'])->name('editstatusCustomer');

});

Route::middleware('auth.user')->prefix('admin/invoice')->group(function(){
    Route::get('/', [InvoiceController::class,'getInvoice'])->name('invoice');
    Route::get('/detail/{id}', [InvoiceController::class,'getDetailInvoice'])->name('detailinvoice');
    Route::get('/active/{id}', [InvoiceController::class,'getActiveInvoice'])->name('activeinvoice');
    Route::get('/inactive/{id}', [InvoiceController::class,'getInactiveInvoice'])->name('inactiveinvoice');
    Route::get('/confirm/{id}', [InvoiceController::class,'getConFirmInvoice'])->name('confirminvoice');
    Route::get('/cancel/{id}', [InvoiceController::class,'getCanCelInvoice'])->name('cancelinvoice');

  
});
//baloi
Route::middleware('auth.admin')->prefix('admin/account')->group(function(){
    Route::get('/', [AccountController::class,'getAccount'])->name('account');
    Route::get('/edit-status/{id}', [AccountController::class,'getEditStatus'])->name('editstatus');
});


