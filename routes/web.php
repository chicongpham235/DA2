<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\NhomsanphamController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\CheckAdminLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ProductShopping;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/login', [AdminLoginController::class,'getlogin'])->name('admin.getlogin');
Route::post('/admin/login', [AdminLoginController::class,'postlogin'])->name('admin.postlogin');
Route::get('/admin/logout', [AdminLoginController::class,'getlogout'])->name('admin.getlogout');

// ->middleware([CheckAdminLogin::class])
Route::prefix('admin')->name('admin.')->middleware([CheckAdminLogin::class])->group(function(){
    Route::get('/', [AdminLoginController::class, 'dashboard'])->name('dashboard');

    Route::get('/file', function () {
        return view('admin.file');
    })->name('file');

    Route::resources([
        'nhomsanpham' => NhomsanphamController::class,
        'sanpham' => SanphamController::class,
        'color' =>ColorController::class,
        'user' => UserManagementController::class,
        'order' => OrderController::class,
    ]);

});

Route::get('/', function () {
    return view('site.index');
})->name('home');

Route::get('/shop', function () {
    return view('site.shop');
})->name('shop');

Route::get('/cart', function () {
    return view('site.cart');
})->name('cart');

Route::get('/search',ProductShopping::class)->name('product_search');
Route::get('/productdetail/{param}',App\Http\Livewire\ProductDetail::class)->name('productdetail');

Route::get('/checkout',App\Http\Livewire\CheckOut::class)->name('checkout');
Route::get("/register", [RegistrationController::class, 'create'])->name('register');
Route::post("/register/create", [RegistrationController::class, 'store']);
Route::get('/returnpayment',App\Http\Livewire\ReturnPayment::class)->name('returnpayment');
