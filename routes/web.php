<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;




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
// Xử lí Home,đăng nhập
route::get("/",[BookController::class,"index"])->name("index");
route::get("/home",[HomeController::class,"index"])->middleware('verified');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// Xử lí giỏ hàng
route::get("/Add-Cart/{id}",[CartController::class,"AddCart"]);
route::get("/Delete-Item-Cart/{id}",[CartController::class,"DeleteItemCart"]);
route::get("/Delete-Item-List-Cart/{id}",[CartController::class,"DeleteListItemCart"]);
route::post("/save-list-item-cart",[CartController::class,"SaveListItemCart"]);
Route::post('/save_all_list_item_cart', [CartController::class, 'SaveAllListItemCart'])->name('save_all_list_item_cart');
Route::get('/view-cart-show', function () {
    return view('view-cart');
});
route::get("/View-List",[CartController::class,"ViewList"]);
//Xử lí thanh toán
Route::post('/process-checkout', [CartController::class, 'ProcessCheckout'])->name('processCheckout');
Route::get('/vnpay/return', [CartController::class, 'vnpayReturn'])->name('vnpay.return');
Route::get('thankyou', [CartController::class, 'Thanhyou'])->name('thankyou');
Route::get('/Products-list', [BookController::class, 'ProductsList']);
route::get("/Check-out",[CartController::class,"Checkout"])->name("checkout");

// Phân quyền người dùng


Route::middleware(['role:2','checkUserNotDeleted'],)->group(function () {
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
});
Route::middleware(['role:0','checkUserNotDeleted'])->group(function () {
    Route::get('/user', [HomeController::class, 'user'])->name('user');
});
Route::middleware(['role:1','checkUserNotDeleted'])->group(function () {
    Route::get('/seller', [HomeController::class, 'seller'])->name('seller');
});





