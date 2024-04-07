<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('v1')->name('api.v1.')->group(function () {

    Route::resource('users', UserController::class);

    Route::controller(BookController::class)->group(function () {
        Route::get('books', 'index')->name('books.index');
        Route::get('books/{id}', 'show')->name('books.show');
        Route::post('books', 'store')->name('books.store');
        Route::post('books/{id}/stores', 'attachStores')->name('books.attach');
        Route::put('books/{id}', 'update')->name('books.update');
        Route::delete('books/{id}', 'destroy')->name('books.delete');
    });
    Route::controller(StoreController::class)->group(function () {
        Route::get('stores', 'index')->name('stores.index');
        Route::get('stores/{id}', 'show')->name('stores.show');
        Route::post('stores', 'store')->name('stores.store');
        Route::post('stores/{id}/books', 'attachBooks')->name('stores.attach');
        Route::put('stores/{id}', 'update')->name('stores.update');
        Route::delete('stores/{id}', 'destroy')->name('stores.delete');
    });
    /** Not using apiresource as task didn't specify PATCH support
    Route::apiresource('books', BookController::class);
    Route::apiresource('stores', StoreController::class);
     **/
});
