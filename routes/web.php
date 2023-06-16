<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;

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
Route::resource('products', ProductController::class);
Route::delete('selectted-products', [ProductController::class, 'deleteChecked'])->name('products.deleteChecked');
Route::get('importExportView', [ProductController::class, 'importExportView']);
Route::get('export-product', [ProductController::class, 'export'])->name('product.export');
Route::post('import-product', [ProductController::class, 'import'])->name('product.import');
Route::get('/search-product', [ProductController::class, 'search']);

Route::resource('category', CategoryController::class);
Route::delete('selectted-category', [CategoryController::class, 'deleteChecked'])->name('category.deleteChecked');
Route::get('importExportView', [CategoryController::class, 'importExportView']);
Route::get('export-category', [CategoryController::class, 'export'])->name('category.export');
Route::post('import-category', [CategoryController::class, 'import'])->name('category.import');
//Route::get('/search-category', [CategoryController::class, 'search']);

Route::resource('supplier', SupplierController::class);
Route::delete('selectted-supplier', [SupplierController::class, 'deleteChecked'])->name('supplier.deleteChecked');
Route::get('importExportView', [SupplierController::class, 'importExportView']);
Route::get('export-supplier', [SupplierController::class, 'export'])->name('supplier.export');
Route::post('import-supplier', [SupplierController::class, 'import'])->name('supplier.import');
//Route::get('/search-supplier', [SupplierController::class, 'search']);
