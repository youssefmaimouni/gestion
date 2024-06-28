<?php

use App\Http\Controllers\categorie;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\magazin;
use App\Http\Controllers\magazinController;
use App\Http\Controllers\marchandiseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\tagController;
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
    return redirect('/home');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::get('/categories', [categorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [categorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [categorieController::class, 'store'])->name('categories.store');
Route::put('/categories/{categorie}', [categorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categorie}', [categorieController::class, 'delete'])->name('categories.delete');
Route::get('/categories/{categories}/edit', [categorieController::class, 'edit'])->name('categories.edit'); 

Route::get('/marchandises', [marchandiseController::class, 'index'])->name('marchandises.index');
Route::get('/marchandises/create', [marchandiseController::class, 'create'])->name('marchandises.create');
Route::post('/marchandises', [marchandiseController::class, 'store'])->name('marchandises.store');
Route::put('/marchandises/{marchandise}', [marchandiseController::class, 'update'])->name('marchandises.update');
Route::delete('/marchandises/delete', [marchandiseController::class, 'delete'])->name('marchandises.delete');
Route::get('/marchandises/{marchandises}/edit', [marchandiseController::class, 'edit'])->name('marchandises.edit');

Route::get('/tags', [tagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [tagController::class, 'create'])->name('tags.create');
Route::post('/tags', [tagController::class, 'store'])->name('tags.store');
Route::put('/tags/{tag}', [tagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}', [tagController::class, 'delete'])->name('tags.delete');
Route::get('/tags/{tags}/edit', [tagController::class, 'edit'])->name('tags.edit');

});

require __DIR__.'/auth.php';
