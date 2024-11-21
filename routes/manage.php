<?php

use App\Http\Controllers\Admin\{CategoriesController , CouponsController , HomeController , HomeSliderController, NewsLetterController, OrdersController , ProductsController , ProfileController , WebsiteController};
use Illuminate\Support\Facades\Route;

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

Route::get('' ,HomeController::class)->name('home');

Route::resource('categories' , CategoriesController::class);
Route::resource('products' , ProductsController::class);
Route::post('products/{product}/home_slider' , [ProductsController::class , 'home_slider'])->name('products.home_slider');
Route::resource('orders' , OrdersController::class);
Route::resource('coupons' , CouponsController::class);
Route::resource('newsletter' , NewsLetterController::class);
Route::resource('home_sliders' , HomeSliderController::class);

Route::get('website-settings' , [WebsiteController::class , 'index'])->name('settings');
Route::put('website-settings' , [WebsiteController::class , 'update']);

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::put('profile' , [ProfileController::class, 'update']);

Route::get('logout', [ProfileController::class , 'logout'])->name('logout');

Route::get('migrate',function()
{
    Artisan::call('migrate');
});
