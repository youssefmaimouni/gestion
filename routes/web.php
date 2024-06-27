<?php

use App\Http\Controllers\categorie;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\magazin;
use App\Http\Controllers\magazinController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
Route::get('/magazins', [magazinController::class, 'index'])->name('magazins.index');
Route::get('/magazins/create', [magazinController::class, 'create'])->name('magazins.create');
Route::post('/magazins', [magazinController::class, 'store'])->name('magazins.store');
Route::put('/magazins/{magazin}', [magazinController::class, 'update'])->name('magazins.update');
Route::delete('/magazins/{magazin}', [magazinController::class, 'delete'])->name('magazins.delete');
Route::get('/magazins/{magazins}/edit', [magazinController::class, 'edit'])->name('magazins.edit'); 

Route::get('/categories', [categorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [categorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [categorieController::class, 'store'])->name('categories.store');
Route::put('/categories/{categorie}', [categorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categorie}', [categorieController::class, 'delete'])->name('categories.delete');
Route::get('/categories/{categories}/edit', [categorieController::class, 'edit'])->name('categories.edit'); 
});

require __DIR__.'/auth.php';
