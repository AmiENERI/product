<?php

use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LanguageController;
use Database\Factories\TypeFactory;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('switchLang');

Route::get('/products/ricerca', [HomeController::class, 'search'])->name('products.search');

Route::get('/products/type/{type}',  [HomeController::class, 'type'])->name('products.type');
Route::get('/products/color/{color}',  [HomeController::class, 'color'])->name('products.color');
Route::get('/products/material/{material}',  [HomeController::class, 'material'])->name('products.material');

Route::get('/contact',  [HomeController::class, 'contatti'])->name('email');
Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('sendEmail');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/about',  [HomeController::class, 'about'])->name('about');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');





// Rotte per la gestione dei generi
Route::get('/types', [TypeController::class, 'index'])->name('types.index');
Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');
Route::post('/types', [TypeController::class, 'store'])->name('types.store');
Route::get('/types/{id}', [TypeController::class, 'show'])->name('types.show');
Route::get('/types/{id}/edit', [TypeController::class, 'edit'])->name('types.edit');
Route::put('/types/{id}', [TypeController::class, 'update'])->name('types.update');
Route::delete('/types/{id}', [TypeController::class, 'destroy'])->name('types.destroy');

// Rotte per la gestione dei colori
Route::get('/colors', [ColorController::class, 'index'])->name('colors.index');
Route::get('/colors/create', [ColorController::class, 'create'])->name('colors.create');
Route::post('/colors', [ColorController::class, 'store'])->name('colors.store');
Route::get('/colors/{id}', [ColorController::class, 'show'])->name('colors.show');
Route::get('/colors/{id}/edit', [ColorController::class, 'edit'])->name('colors.edit');
Route::put('/colors/{id}', [ColorController::class, 'update'])->name('colors.update');
Route::delete('/colors/{id}', [ColorController::class, 'destroy'])->name('colors.destroy');

// Rotte per la gestione dei fornitori
Route::get('/producers', [ProducerController::class, 'index'])->name('producers.index');
Route::get('/producers/create', [ProducerController::class, 'create'])->name('producers.create');
Route::post('/producers', [ProducerController::class, 'store'])->name('producers.store');
Route::get('/producers/{id}', [ProducerController::class, 'show'])->name('producers.show');
Route::get('/producers/{id}/edit', [ProducerController::class, 'edit'])->name('producers.edit');
Route::put('/producers/{id}', [ProducerController::class, 'update'])->name('producers.update');
Route::delete('/producers/{id}', [ProducerController::class, 'destroy'])->name('producers.destroy');

// Rotte per la gestione degli venditori
Route::get('/sellers', [SellerController::class, 'index'])->name('sellers.index');
Route::get('/sellers/create', [SellerController::class, 'create'])->name('sellers.create');
Route::post('/sellers', [SellerController::class, 'store'])->name('sellers.store');
Route::get('/sellers/{id}', [SellerController::class, 'show'])->name('sellers.show');
Route::get('/sellers/{id}/edit', [SellerController::class, 'edit'])->name('sellers.edit');
Route::put('/sellers/{id}', [SellerController::class, 'update'])->name('sellers.update');
Route::delete('/sellers/{id}', [SellerController::class, 'destroy'])->name('sellers.destroy');


