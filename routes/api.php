<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\GroupController;
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

Route::get('/book', [BookController::class, 'index']);
Route::get('/book/{slug}', [BookController::class, 'show']);
Route::post('/book', [BookController::class, 'store']);

Route::get('/files', [FilesController::class, 'index']);
Route::post('/files', [FilesController::class, 'upload']);

Route::get('/group', [GroupController::class, 'index']);
// Route::get('/group', [GroupController::class, 'showBookByGroup']);

// Route::get('/group', [GroupController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
