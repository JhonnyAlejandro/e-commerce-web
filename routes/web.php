<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/tienda', [App\Http\Controllers\StoreController::class, 'store'])->name('store');
Route::match(['get', 'post'], '/tienda/{name}', [App\Http\Controllers\StoreController::class, 'productOverview'])->name('productOverview');
Route::post('/favoritos/{product}', [App\Http\Controllers\StoreController::class, 'favorites'])->name('favorites');
Route::view('/sobre-nosotros', 'about-us');
Route::get('/contactanos', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');

Route::view('/politicas', 'policy');
Route::view('/terminos', 'terms');
Route::view('/preguntas', 'questions');

Route::resource('/productos', App\Http\Controllers\ProductController::class)->names('products')->middleware('auth');
Route::resource('/categorias', App\Http\Controllers\CategoryController::class)->names('categories')->middleware('auth');
Route::resource('/referencias', App\Http\Controllers\ReferenceController::class)->names('references')->middleware('auth');
Route::get('/ventas', [App\Http\Controllers\SaleController::class, 'index'])->name('sales')->middleware('auth');
