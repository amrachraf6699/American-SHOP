<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\AddressesController;
use App\Http\Controllers\User\OrdersController;
use App\Http\Controllers\WishListController;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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
Route::get('', [ProfileController::class, 'index'])->name('user.index');
Route::get('edit', [ProfileController::class, 'edit'])->name('user.edit');
Route::post('edit', [ProfileController::class, 'update'])->name('user.profile.update');
ROute::post('updatepassword', [ProfileController::class , 'updatepassword'])->name('user.password.update');


Route::post('wish/{product}', [WishListController::class, 'wish'])->name('wish');
Route::get('wish/clear', [WishListController::class, 'clear'])->name('wish.clear');

Route::get('cart' , [CartController::class, 'index'])->name('cart.index');
Route::post('cart', [CartController::class, 'add'])->name('cart.add');
Route::post('updatecart', [CartController::class, 'update'])->name('cart.update');
Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::post('cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');


Route::Get('addresses' , [AddressesController::class, 'index'])->name('addresses.index');
Route::get('addresses/create', [AddressesController::class, 'create'])->name('addresses.create');
Route::post('addresses', [AddressesController::class, 'store'])->name('addresses.store');
Route::get('addresses/{address}/edit', [AddressesController::class, 'edit'])->name('addresses.edit');
Route::put('addresses/{address}', [AddressesController::class, 'update'])->name('addresses.update');
Route::delete('addresses/{address}', [AddressesController::class, 'destroy'])->name('addresses.destroy');
Route::post('addresses/{address}/default', [AddressesController::class, 'default'])->name('addresses.default');
Route::get('logout', [ProfileController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'orders', 'as' => 'orders.', 'controller' => OrdersController::class], function()
{
    Route::get('', 'index')->name('index');
    Route::post('place' , 'place')->name('place');
    Route::get('{order}', 'show')->name('show');
    Route::get('{order}/feedback', 'feedback')->name('feedback');
    Route::post('{order}/feedback', 'submitFeedback');
    Route::get('{order}/invoice', 'invoice')->name('invoice');
});
