<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProducttypeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;


Route::get('/', function () {
  return view('welcome');
});
Route::get('user/login', [LoginController::class, 'Login'])->name('user.login');
Route::post('user/login', [LoginController::class, 'postLogin'])->name('user.login.submit');
Route::get('user/logout', [LoginController::class, 'logout'])->name('user.logout');
Route::get('user/register', [RegisterController::class, 'register'])->name('user.register');
Route::post('user/register', [RegisterController::class, 'store'])->name('user.register.submit');
Route::get('/forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forget-password', [ForgetPasswordController::class, 'sendPasswordResetEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset-passwords/submit', [ForgetPasswordController::class, 'resetPasswordSubmit'])->name('resetPasswordSubmit');
Route::get('auth/google', [LoginController::class, 'signInwithGoogle']);
Route::get('callback/google', [LoginController::class, 'callbackToGoogle']);

Route::group([ 'prefix' => 'user', 'middleware' => 'userAuth:web'],function () {

  Route::get('/account', [AboutController::class, 'index'])->name('user.account');
  Route::get('/home', [ProductController::class, 'home'])->name('user.home');
  Route::post('/add-interest', [AboutController::class, 'addInterest'])->name('user.add-interest');
  Route::get('/interests', [AboutController::class, 'interests'])->name('user.interests');
  Route::get('/productoffer/{id}', [ProductController::class, 'productoffer'])->name('user.productoffer');
 
  Route::get('/swap', [AboutController::class, 'view'])->name('user.swap');
  Route::delete('remove/data/{id}', [AboutController::class, 'removeData'])->name('remove.data');
  Route::get('/Swap', [ProductController::class, 'swap'])->name('swap');
  Route::post('/swap-product', [ProductController::class, 'swapProduct'])->name('swap.product');
  Route::post('/accept-or-reject-swap/{id}', [ProductController::class, 'acceptOrRejectSwap'])->name('accept.reject.swap');


  Route::get('/myproduct', [ProductController::class, 'myproduct'])->name('user.myproduct');
 
  Route::get('/product', [ProductController::class, 'index'])->name('user.product');
  Route::post('product', [ProductController::class, 'store'])->name('product.store');
  Route::delete('product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
  Route::post('api/fetch-subcategory', [ProductController::class, 'fetchSubcategory'])->name('api/fetch-subcategory');
  Route::post('api/fetch-product_type_id', [ProductController::class, 'fetchProducttype'])->name('api/fetch-product_type_id');
  Route::post('/get-category-info', [ProductController::class, 'getCategoryInfo'])->name('get-category-info');

  //Favorite
  Route::get('/favorite', [WishlistController::class, 'favorite'])->name('user.favorite');
  Route::post('favorite-add', [WishlistController::class, 'favoriteAdd'])->name('favorite.add');
  Route::delete('favorite-remove/{id}', [WishlistController::class, 'favoriteRemove'])->name('favorite.remove');
});




//Admin
Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('/admin/login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

  Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
  Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');


  // Sub subcategories routes
  // Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
  // Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
  // Route::post('/subcategories/create', [SubCategoryController::class, 'store'])->name('subcategories.store');

  // Sub category routes
  Route::get('category', [CategoryController::class, 'index'])->name('category.index');
  Route::post('category', [CategoryController::class, 'store'])->name('category.store');
  Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
  Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
  Route::delete('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
  Route::post('/category-status-update', 'CategoryController@status_update')->name('category.status.update');

  // Sub subcategory routes
  Route::get('subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
  Route::post('subcategory', [SubCategoryController::class, 'store'])->name('subcategory.store');
  Route::get('subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
  Route::post('subcategory/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
  Route::delete('subcategory/destroy/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');

  // SubProduct_type routes
  Route::get('Product_type', [ProducttypeController::class, 'index'])->name('Producttype.index');
  Route::post('Product_type', [ProducttypeController::class, 'store'])->name('Producttype.store');
  Route::get('Product_type/edit/{id}', [ProducttypeController::class, 'edit'])->name('Producttype.edit');
  Route::post('Product_type/update', [ProducttypeController::class, 'update'])->name('Producttype.update');
  Route::delete('Product_type/destroy/{id}', [ProducttypeController::class, 'destroy'])->name('Producttype.destroy');
});
