<?php

use App\Http\Controllers\AddToCardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

// Route::post('/addcard', [AddToCardController::class, 'addToCard']);
// Route::post('/add-to-cart', [AddToCardController::class, 'addToCard']);
Route::post('/add-to-cart', [AddToCardController::class, 'addToCard']);

Route::get('/card', [AddToCardController::class, 'index']);
// Route::post('/products/store', [ProductController::class, 'storee']);

