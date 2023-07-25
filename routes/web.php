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
Route::get('/tienda/{name}', [App\Http\Controllers\StoreController::class, 'productOverview'])->name('productOverview');
Route::get('/sobre-nosotros', [App\Http\Controllers\CompanyController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contactanos', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact');

Route::resource('/productos', App\Http\Controllers\ProductController::class)->names('products')->middleware('auth');
Route::resource('/categorias', App\Http\Controllers\CategoryController::class)->names('categories')->middleware('auth');

Route:: get('/politicas', function(){
    return view('policy');
});

Route:: get('/terminos', function(){
    return view('terms');
});

Route:: get('/preguntas', function(){
    return view('questions');
});
