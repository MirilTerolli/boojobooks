<?php

use App\Http\Controllers\GoogleApiController;
use App\Http\Controllers\UserBooksCollectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('search-book/{search}', [GoogleApiController::class, 'search'])->where('search', '(.*)');
    Route::get('user-book-collection/{user_id}', [UserBooksCollectionController::class, 'show']);
    Route::post('user-book-collection', [UserBooksCollectionController::class, 'store']);
});
