<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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

route::get('/', [HomeController::class, 'index']);

route::get('/home', [AdminController::class, 'index']);

route::get('/categorie_page', [AdminController::class, 'categorie_page']);

route::post('/add_category', [AdminController::class, 'add_category']);

route::get('/cat_delete/{id}', [AdminController::class, 'cat_delete']);

route::get('/cat_edit/{id}', [AdminController::class, 'cat_edit']);

route::post('/update_category/{id}', [AdminController::class, 'update_category']);

route::get('/add_product', [AdminController::class, 'add_product']);

route::get('/show_product', [AdminController::class, 'show_product']);

route::get('/product_delete/{id}', [AdminController::class, 'product_delete']);

route::get('/update_product/{id}', [AdminController::class, 'update_product']);



route::post('/store_product', [AdminController::class, 'store_product']);








Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});








