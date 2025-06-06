<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRolesMiddleware;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/check-session', function () {
    session(['test' => 'session working']);
    return session('test');
});
// Login & logout route
Route::get('/login', [AuthController::class, 'login_show'])->name('login.show'); 
Route::post('login_auth',[AuthController::class,'login_auth'])->name('login.auth');
Route::get('/signup',[AuthController::class, 'signup_show'])->name('signup.show');
Route::post('/signup_auth',[AuthController::class, 'signup_auth'])->name('signup.auth');
Route::get('/resetpasswordemail',[AuthController::class, 'passwordemail_show'])->name('password_email.show');
Route::post('/resetpasswordemailauth',[AuthController::class, 'passwordemail_auth'])->name('password_email.auth');
Route::get('/resetpassword',[AuthController::class, 'password_show'])->name('password.show');
Route::post('/resetpasswordauth',[AuthController::class, 'password_auth'])->name('password.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang hanya bisa diakses customer
    Route::get('/landing',[HomeController::class,'landing_show'])->name('landing.show');
    Route::get('/aboutUs',[HomeController::class,'aboutus_show'])->name('aboutus.show');
    Route::get('/layanan/{kategori}/{category_id}',[HomeController::class,'layanan_customer_show'])->name('layanan_customer.show');
    Route::get('/produk_detail/{id}',[HomeController::class,'produk_detail_show'])->name('produk_detail.show');
    Route::get('/cart',[HomeController::class,'cart_show'])->name('cart.show');
    Route::get('/order',[HomeController::class,'order_show'])->name('order.show');
    Route::get('/biodata',[ProfileController::class,'show'])->name('biodata.show');
    Route::get('/alamat', [ProfileController::class, 'alamat_show'])->name('alamat.show');
    Route::get('/wishlist', [ProfileController::class, 'wishlist_show'])->name('wishlist.show');
    Route::get('/transaksi',[ProfileController::class,'transaksi_show'])->name('transaksi.show');
    Route::get('/ulasan',[ProfileController::class,'ulasan_show'])->name('ulasan.show');
    Route::post('/alamat', [ProfileController::class, 'store'])->name('alamat.store');


// Route yang hanya bisa diakses admin
    Route::get('/layanan_admin/{kategori}/{category_id}',[AdminController::class,'layanan_admin_show'])->name('layanan_admin.show');
    Route::get('/admin/add', [AdminController::class, 'addServices_show'])->name('addservices.show');
    Route::get('/admin/edit/{service_id}', [AdminController::class, 'editServices_show'])->name('editservices.show');
    Route::put('/admin/update/{service_id}', [AdminController::class, 'updateService'])->name('layanan.update');
    Route::get('/admin/landing', [AdminController::class, 'landing_show'])->name('landing_admin.show');
    Route::get('/admin/order_detail', [AdminController::class, 'order_show'])->name('order_admin.show');
    Route::post('/layanan-demo', [AdminController::class, 'demoSubmit'])->name('layanan.demoSubmit');