<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

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

Route::get('/', function () {
    return view('/welcome');
});

//Route::get('/', [ListController::class, 'index']);
/* Route::get('/list', [ListController::class, 'index']);
Route::get('/create', [ListController::class, 'create']);
Route::post('/store', [ListController::class, 'store']);
Route::get('/{id}/edit', [ListController::class, 'edit']);
Route::put('/{id}', [ListController::class, 'update']);
Route::delete('/{id}', [ListController::class, 'destroy']); */

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/list', [ListController::class, 'index']);
    Route::get('/create', [ListController::class, 'create']);
    Route::post('/store', [ListController::class, 'store']);
    Route::get('/{id}/edit', [ListController::class, 'edit']);
    Route::put('/{id}', [ListController::class, 'update']);
    Route::delete('/{id}', [ListController::class, 'destroy']);
});
