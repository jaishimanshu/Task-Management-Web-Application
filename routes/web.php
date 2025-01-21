<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

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
Route::post('/delete-status', [StoreController::class, 'deleteStatus']);

Route::post('/update-status', [StoreController::class, 'updateStatus']);

Route::post('/update-data', [StoreController::class, 'updateData']);

Route::get('/filter-tasks', [StoreController::class, 'filterTasks']);

Route::get('/',[StoreController::class,'home']);

Route::get('/edit/{id}', [StoreController::class, 'edit']);

Route::get('/view',[StoreController::class,'index']);

Route::post('/store',[StoreController::class,'store']);

