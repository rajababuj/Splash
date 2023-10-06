<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\subcategoryController;
use App\Http\Controllers\Api\ProducttypeController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\SwapController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);

    Route::get('subcategory', [SubCategoryController::class, 'index']);
    Route::post('subcategory', [SubCategoryController::class, 'store']);

    Route::get('Product_type', [ProducttypeController::class, 'index']);
    Route::post('Product_type', [ProducttypeController::class, 'store']);

    Route::get('/favorite', [WishlistController::class, 'favorite']);
    Route::post('favorite-add', [WishlistController::class, 'favoriteAdd'])->middleware('auth:api');
    Route::delete('favorite-remove/{id}', [WishlistController::class, 'favoriteRemove']);

    Route::get('/swap', [SwapController::class, 'view']);
    Route::post('/swap-product', [SwapController::class, 'swapProduct'])->middleware('auth:api');

    Route::get('/myproduct', [ProductController::class, 'myproduct']);

    Route::get('/home', [ProductController::class, 'home']);
    Route::get('/product', [ProductController::class, 'index']);
    Route::post('product', [ProductController::class, 'store'])->middleware('auth:api');
});
