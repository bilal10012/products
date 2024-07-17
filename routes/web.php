<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products',[ProductController::class,'store'])->name('products');
Route::post('/products',[ProductController::class,'create'])->name('create');
Route::get('/showproducts',[ProductController::class,'show'])->name('showproducts');
Route::get('/manage{id}',[ProductController::class,'manage'])->name('manage');
Route::post('/manage', [ProductController::class, 'storeVariants'])->name('store.variants');
Route::get('/products/{id}/manage-values', [ProductController::class, 'managevalues'])->name('manage-values');
Route::get('/manage-attribute-values/{id}', [ProductController::class, 'manageattributevalues'])->name('manage-attribute-values');

Route::post('/form', [ProductController::class, 'submitForm'])->name('form.submit');
