<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Khai báo các Controller sẽ dùng
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProductFrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\admin\SettingController;

/*
|--------------------------------------------------------------------------
| PHẦN 1: KHÁCH HÀNG (FRONT-END)
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- CÁC ROUTE TĨNH (About, Contact, Cart...) ---
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/checkout', function () { return view('checkout'); })->name('checkout');
Route::get('/order', function () { return view('order'); })->name('order');
Route::get('/add_to_wishlist', function () { return view('add_to_wishlist'); })->name('add_to_wishlist');
Route::get('/wishlist', function () { return view('wishlist'); })->name('wishlist');
Route::get('/category_user', function () { return view('category_user'); })->name('category_user');

// --- ROUTE GIỎ HÀNG ---
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/remove-from-cart', [CartController::class, 'removeCart'])->name('cart.remove');
Route::patch('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/buy-now', [CartController::class, 'buyNow'])->name('cart.buyNow');
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('cart.placeOrder');

// --- QUAN TRỌNG: ROUTE XEM DANH MỤC (MEN/WOMEN) ---
// Đây là dòng giúp link http://.../category/1 hoạt động
Route::get('/category/{id}', [HomeController::class, 'viewCategory'])->name('category.view');

// --- ROUTE SẢN PHẨM ---
// Danh sách sản phẩm chung
Route::get('/products', [HomeController::class, 'listProducts'])->name('products.list');
// Chi tiết sản phẩm
Route::get('/product/{id}', [ProductFrontendController::class, 'show'])->name('product.detail');

// --- ROUTE GỬI LIÊN HỆ ---
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// --- ROUTE TRA CỨU ĐƠN HÀNG ---
Route::match(['get', 'post'], '/order-tracking', [HomeController::class, 'tracking'])->name('order.tracking');

// --- ROUTE TÌM KIẾM SẢN PHẨM ---
Route::get('/search', [HomeController::class, 'search'])->name('product.search');

/*
|--------------------------------------------------------------------------
| PHẦN 2: ADMIN (QUẢN TRỊ)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    // Route cấu hình chung (settings)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Các route xác thực (Login/Register)
Auth::routes();

// Route mặc định của Laravel sau khi login (có thể giữ hoặc bỏ)
Route::get('/home', [HomeController::class, 'index'])->name('home_logged_in');  