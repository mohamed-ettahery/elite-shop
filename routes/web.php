<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// })->name("home");
Route::get('/', "App\Http\Controllers\GeneralController@hompage")->name('home');
Route::get('/contact', function () {
    return view('contact');
})->name("contact");
Route::get('/shop', "App\Http\Controllers\ShopController@index")->name('shop');
Route::get('/shop/{product}', "App\Http\Controllers\ShopController@show")->name('details');
Route::post('/cart/add', "App\Http\Controllers\ShopController@addToCart")->name('addToCart');
Route::post('/cart/delete', "App\Http\Controllers\ShopController@deleteCartProduct")->name('deleteCartProduct');
Route::get('/shop/categories/{category}', "App\Http\Controllers\ShopController@showCategory")->name('showCategory');
// Route::get('/checkout', function () {
//     return view('checkout');
// })->name("checkout");
Route::post('/shop/send-order', "App\Http\Controllers\ShopController@sendOrder")->name('sendOrder');
// Route::get('/send', "App\Http\Controllers\ShopController@testOrder")->name("testOrder");
Route::get('/cart', "App\Http\Controllers\ShopController@viewCart")->name('cart');
Route::get('/orders', "App\Http\Controllers\ShopController@viewOrders")->name('viewOrders');
Route::get('/order/details/{orderId}', 'App\Http\Controllers\ShopController@getOrderDetails')->name("getOrderDetails");
//search
Route::get('/search', 'App\Http\Controllers\SearchController@search')->name('search');
// Profile
Route::get('/profile', 'App\Http\Controllers\UserController@index')->name('profile');
Route::put('/profile/update', 'App\Http\Controllers\UserController@updateProfile')->name('updateProfile');
Route::get('/password', 'App\Http\Controllers\UserController@password')->name('password');
Route::put('/password/update', 'App\Http\Controllers\UserController@updatePassword')->name('updatePassword');

Route::get('/login', "App\Http\Controllers\LoginController@index")->name('login.index');
Route::post('/login', "App\Http\Controllers\LoginController@verify")->name('login.verify');
Route::post('/signUp', "App\Http\Controllers\LoginController@signup")->name('signup');
Route::get('/logout', "App\Http\Controllers\LoginController@logOut")->name('logout');

// Newsletter
Route::post('/newsletter/subscribe', "App\Http\Controllers\NewsletterController@subscribe")->name('newsletter.subscribe');
// Contact Mail
Route::post('/contact', "App\Http\Controllers\ContactFormController@submit")->name('contact.submit');

//ADMIN
Route::middleware(['admin'])->prefix('owner')->group(function () {
    // Route::get('/', function () {
    //     return view('admin/dashboard');
    // })->name("dashboard");
    Route::get('/', 'App\Http\Controllers\admin\DashboardController@index')->name('dashboard');
    // Profile
    Route::get('/profile', 'App\Http\Controllers\admin\AdminController@adminProfile')->name('adminProfile');
    Route::put('/profile/update', 'App\Http\Controllers\admin\AdminController@updateAdminProfile')->name('updateAdminProfile');
    Route::get('/password', 'App\Http\Controllers\admin\AdminController@adminPassword')->name('adminPassword');
    Route::put('/password/update', 'App\Http\Controllers\admin\AdminController@updateAdminPassword')->name('updateAdminPassword');

    Route::resource('categories', 'App\Http\Controllers\admin\CategoryController');
    Route::resource('products', 'App\Http\Controllers\admin\ProductController');
    Route::resource('users', 'App\Http\Controllers\admin\UserController');
    Route::resource('newsletters', 'App\Http\Controllers\admin\NewsletterController');
    Route::delete('/newsletters/{subscriber}', "App\Http\Controllers\admin\NewsletterController@destroy")->name('newsletters.destroy');
    Route::resource('admins', 'App\Http\Controllers\admin\AdminController');
    Route::resource('orders', 'App\Http\Controllers\admin\OrderController');
    Route::get('/orders/confirm/{order}', "App\Http\Controllers\admin\OrderController@ConfirmOrder")->name('orders.confirm');
});
