<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/provider', [App\Http\Controllers\ProviderController::class, 'index'])->name('daftarProvider');

Route::get('/pulsa', [App\Http\Controllers\PulsaController::class, 'index'])->name('daftarPulsa');

Route::get('/provider/create', [App\Http\Controllers\ProviderController::class, 'create'])->name('createProvider');

Route::post('/provider/create', [App\Http\Controllers\ProviderController::class, 'store'])->name('storeProvider');

Route::get('/provider/{id}/edit', [App\Http\Controllers\ProviderController::class, 'edit'])->name('editProvider');

Route::post('/provider/{id}/edit', [App\Http\Controllers\ProviderController::class, 'update'])->name('updateProvider');

Route::get('/pulsa/create', [App\Http\Controllers\PulsaController::class, 'create'])->name('createPulsa');

Route::post('/pulsa/create', [App\Http\Controllers\PulsaController::class, 'store'])->name('storePulsa');

Route::get('/pulsa/{id}/edit', [App\Http\Controllers\PulsaController::class, 'edit'])->name('editPulsa');

Route::post('/pulsa/{id}/edit', [App\Http\Controllers\PulsaController::class, 'update'])->name('updatePulsa');

Route::get('/provider/{id}/delete', [App\Http\Controllers\ProviderController::class, 'destroy'])->name('deleteProvider');

Route::get('/pulsa/{id}/delete', [App\Http\Controllers\PulsaController::class, 'destroy'])->name('deletePulsa');