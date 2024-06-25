<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Redirect;




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
// 
route::get("/book-detail/{id}",[BookController::class,"BookDetail"])->name("book.detail");
Route::get('/infor-details/{orderId}', [OrderController::class, 'InforDetails'])->name('infor.details');
// Xử lí các chức năng header
route::get("/list-book",[BookController::class,"ListBook"])->name("list.book");
Route::get('/category/{category}', [BookController::class, 'productsCategory'])->name('category.products');
Route::get('/search', [BookController::class, 'searchBook'])->name('product.search');
route::get("/header1",[HomeController::class,"header"])->name("header");
Route::get('/author/{author}', [BookController::class, 'booksByAuthor'])->name('author.products');
route::get("/blog",[HomeController::class,"ListBlog"])->name("blog.home");
// Xử lí contact
route::get("/contact",[HomeController::class, 'formContact'])->name("contact");
Route::post('/contact', [HomeController::class, 'submit'])->name('contact.submit');
// Xử lí giỏ hàng
route::get("/Add-Cart/{id}",[CartController::class,"AddCart"]);
route::get("/Add-Cart-Detail/{id}",[CartController::class,"AddCartDetail"])->name("addcart.detail");
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
route::get("/Check-out",[CartController::class,"Checkout"])->name("checkout");
Route::get('/infor-details/{orderId}', [OrderController::class, 'InforDetails'])->name('infor.details');//Hiển thị chi tiết thông tin đơn hàng
Route::get('/order-details/{orderId}', [OrderController::class, 'OrderDetails'])->name('order.details');//Hiển thị chi tiết sản phẩm trong đơn hàng

// Phân quyền người dùng

// Xử lí các chức năng của Admin
Route::middleware(['role:2', 'checkUserNotDeleted',])->group(function () {
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
    Route::get('/customer-list', [HomeController::class, 'CustomersList'])->name("user-list"); //Hiển thị danh sách tài khoản
});
 // các chức năng của seller
 Route::middleware(['role:1', 'checkUserNotDeleted',])->group(function () {
    Route::get('seller',[HomeController::class, 'seller'])->name('seller');
    Route::get('seller/list-users',[HomeController::class,"Userlist"])->name("user.list");
});
 //Các chức năng của user
Route::middleware(['role:0','checkUserNotDeleted', ])->group(function () {
    Route::get('/user', [HomeController::class, 'user'])->name('user');
    route::get('/orders/cancel-form/{orderId}',[OrderController::class,'formCancel'])->name('cancel.form');//Form Hủy đơn hàng 
    route::post('/orders/cancel-order/{id}',[OrderController::class,'cancelOrder'])->name('cancel.order');//Hủy đơn hàng 
    Route::get('/Order-list-user', [OrderController::class, 'OrderListUser'])->name("orderlist.user"); // Hiển thị danh sách đơn hàng của user
    
    //Hiển thị chi tiết thông tin đơn hàng
    Route::get('/orders/edit-user/{orderId}', [OrderController::class, 'showuser'])->name('form-user-update');//Form cập nhập đơn hàng của user
    Route::post('/orders/edit-user/{orderId}', [OrderController::class, 'edituser'])->name('order-user.update');//Form cập nhập đơn hàng
}); 
// Các chức năng của admin và seller
Route::middleware(['role:1,2', 'checkUserNotDeleted',])->group(function () {
     
    // Route các chức năng quản lí người dùng
    Route::get('/users/delete/{user}', [HomeController::class, 'Destroy'])->name('users.destroy'); //Xóa mềm tài khoản
    Route::get('/users/restore/{user}', [HomeController::class, 'Restore'])->name('users.restore'); //Khôi phục tài khoản
    Route::get('/users/edit-users/{id}', [HomeController::class, 'show'])->name('form-edit-user');//Form Cập nhật thông tin khách hàng
    Route::post('/users/edit-users/{id}', [HomeController::class, 'edit'])->name('home.edit-user');//Edit sản phẩm
     // Route các chức năng quản lí sản phảm
     Route::get('/Products-list', [BookController::class, 'ProductsList'])->name("product-list"); // Hiển thị danh sách sản phẩm
     Route::get('/products/form-add', [BookController::class, 'form_add'])->name('add-product');//Form Thêm sản phẩm
     Route::get('/products/edit-product/{id}', [BookController::class, 'show'])->name('form-edit');//Form Edit sản phẩm
     Route::post('/products/create', [BookController::class, 'store'])->name('products.create');//Thêm sản phẩm
     Route::post('/products/edit-product/{id}', [BookController::class, 'edit'])->name('home.edit');//Edit sản phẩm
     Route::get('/products/delete/{user}', [BookController::class, 'Destroy'])->name('product.destroy'); //Xóa mềm sản phẩm
     Route::get('/products/restore/{user}', [BookController::class, 'Restore'])->name('product.restore'); //Khôi phục sản phẩm
     // Route các chức năng quản lí đơn hàng
    Route::get('/Order-list', [OrderController::class, 'OrderList'])->name("orderlist"); // Hiển thị danh sách đơn hàng
    route::get('admin/orders/cancel-form/{orderId}',[OrderController::class,'formCancelAdmin'])->name('cancel.formadmin');//Form Hủy đơn hàng 
    route::post('admin/orders/cancel-order/{id}',[OrderController::class,'cancelOrderAdmin'])->name('cancel.orderadmin');//Hủy đơn hàng 
    Route::get('/orders/edit-order/{orderId}', [OrderController::class, 'show'])->name('form-order-update');//Form cập nhập đơn hàng
    Route::post('/orders/edit-order/{orderId}', [OrderController::class, 'edit'])->name('order.update');//Form cập nhập đơn hàng
    // Quản lí contact
    route::get("admin/contact",[HomeController::class, 'formContactAdmin'])->name("admin.contact");
    route::get("/contact/delete/{id}",[HomeController::class, 'DeleteContact'])->name("delete.contact"); 
});









