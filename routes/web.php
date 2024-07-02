<?php

use App\Http\Controllers\categorieController;
use App\Http\Controllers\entreController;
use App\Http\Controllers\marchandiseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sortieController;
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


Route::get('/documents', [categorieController::class, 'index'])->name('categories.index');
Route::get('/categories', [categorieController::class, 'index_cat'])->name('categories.index_cat');
Route::get('/categories/create', [categorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [categorieController::class, 'store'])->name('categories.store');
Route::put('/categories/{categorie}', [categorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categorie}', [categorieController::class, 'delete'])->name('categories.delete');
Route::get('/categories/{categories}/edit', [categorieController::class, 'edit'])->name('categories.edit'); 
Route::get('/categories/{categories}/documents', [categorieController::class, 'entre_sortie'])->name('categories.entre_sortie'); 
Route::get('/categories/{categories}/documents/entres', [categorieController::class, 'entre'])->name('categories.entre'); 
Route::get('/categories/{categories}/documents/sorties', [categorieController::class, 'sortie'])->name('categories.sortie'); 
Route::get('/categories/{categories}', [categorieController::class, 'index_mar'])->name('categories.index_mar');
Route::get('/categories/entre/{entre}', [categorieController::class, 'index_mar_acheter'])->name('categories.index_mar_a');
Route::get('/categories/sortie/{sorties}', [categorieController::class, 'index_mar_vendre'])->name('categories.index_mar_v');



Route::get('/marchandises', [marchandiseController::class, 'index'])->name('marchandises.index');
Route::get('/marchandises/create', [marchandiseController::class, 'create'])->name('marchandises.create');
Route::post('/marchandises', [marchandiseController::class, 'store'])->name('marchandises.store');
Route::put('/marchandises/{marchandise}', [marchandiseController::class, 'update'])->name('marchandises.update');
Route::delete('/marchandises/delete', [marchandiseController::class, 'delete'])->name('marchandises.delete');
Route::get('/marchandises/{marchandises}/edit', [marchandiseController::class, 'edit'])->name('marchandises.edit');


Route::get('/entres/create', [entreController::class, 'create'])->name('entres.create');
Route::post('/entres', [entreController::class, 'store'])->name('entres.store');
Route::put('/entres/{entre}', [entreController::class, 'update'])->name('entres.update');
Route::delete('/entres/{entre}', [entreController::class, 'delete'])->name('entres.delete');
Route::get('/entres/{entres}/edit', [entreController::class, 'edit'])->name('entres.edit');
Route::get('/entres/{entres}/{categories}/mar', [entreController::class, 'acheter'])->name('entres.mar');
Route::get('/sorties/{sorties}/{categories}/mar', [sortieController::class, 'vendre'])->name('sorties.mar');

Route::get('/sorties', [sortieController::class, 'index'])->name('sorties.index');
Route::get('/sorties/create', [sortieController::class, 'create'])->name('sorties.create');
Route::post('/sorties', [sortieController::class, 'store'])->name('sorties.store');
Route::put('/sorties/{sortie}', [sortieController::class, 'update'])->name('sorties.update');
Route::delete('/sorties/{sortie}', [sortieController::class, 'delete'])->name('sorties.delete');
Route::get('/sorties/{sorties}/edit', [sortieController::class, 'edit'])->name('sorties.edit');

});

require __DIR__.'/auth.php';
