<?php

use App\Http\Controllers\acheterController;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\entreController;
use App\Http\Controllers\fournisseurController;
use App\Http\Controllers\marchandiseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sortieController;
use App\Http\Controllers\tagController;
use App\Http\Controllers\vendreController;
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

Route::get('/tags', [tagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [tagController::class, 'create'])->name('tags.create');
Route::post('/tags', [tagController::class, 'store'])->name('tags.store');
Route::put('/tags/{tag}', [tagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag}', [tagController::class, 'delete'])->name('tags.delete');
Route::get('/tags/{tags}/edit', [tagController::class, 'edit'])->name('tags.edit');

Route::get('/acheters', [acheterController::class, 'index'])->name('acheters.index');
Route::get('/acheters/create', [acheterController::class, 'create'])->name('acheters.create');
Route::post('/acheters', [acheterController::class, 'store'])->name('acheters.store');
Route::put('/acheters/{acheter}', [acheterController::class, 'update'])->name('acheters.update');
Route::delete('/acheters/{acheter}', [acheterController::class, 'delete'])->name('acheters.delete');
Route::get('/acheters/{acheters}/edit', [acheterController::class, 'edit'])->name('acheters.edit');

Route::get('/clients', [clientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [clientController::class, 'create'])->name('clients.create');
Route::post('/clients', [clientController::class, 'store'])->name('clients.store');
Route::put('/clients/{client}', [clientController::class, 'update'])->name('clients.update');
Route::delete('/clients/delete', [clientController::class, 'delete'])->name('clients.delete');
Route::get('/clients/{clients}/edit', [clientController::class, 'edit'])->name('clients.edit');


Route::get('/entres/create', [entreController::class, 'create'])->name('entres.create');
Route::post('/entres', [entreController::class, 'store'])->name('entres.store');
Route::put('/entres/{entre}', [entreController::class, 'update'])->name('entres.update');
Route::delete('/entres/{entre}', [entreController::class, 'delete'])->name('entres.delete');
Route::get('/entres/{entres}/edit', [entreController::class, 'edit'])->name('entres.edit');
Route::get('/entres/{entres}/{categories}/mar', [entreController::class, 'acheter'])->name('entres.mar');
Route::get('/sorties/{sorties}/{categories}/mar', [sortieController::class, 'vendre'])->name('sorties.mar');

Route::get('/fournisseurs', [fournisseurController::class, 'index'])->name('fournisseurs.index');
Route::get('/fournisseurs/create', [fournisseurController::class, 'create'])->name('fournisseurs.create');
Route::post('/fournisseurs', [fournisseurController::class, 'store'])->name('fournisseurs.store');
Route::put('/fournisseurs/{fournisseur}', [fournisseurController::class, 'update'])->name('fournisseurs.update');
Route::delete('/fournisseurs/delete', [fournisseurController::class, 'delete'])->name('fournisseurs.delete');
Route::get('/fournisseurs/{fournisseurs}/edit', [fournisseurController::class, 'edit'])->name('fournisseurs.edit');

Route::get('/sorties', [sortieController::class, 'index'])->name('sorties.index');
Route::get('/sorties/create', [sortieController::class, 'create'])->name('sorties.create');
Route::post('/sorties', [sortieController::class, 'store'])->name('sorties.store');
Route::put('/sorties/{sortie}', [sortieController::class, 'update'])->name('sorties.update');
Route::delete('/sorties/{sortie}', [sortieController::class, 'delete'])->name('sorties.delete');
Route::get('/sorties/{sorties}/edit', [sortieController::class, 'edit'])->name('sorties.edit');

Route::get('/vendres', [vendreController::class, 'index'])->name('vendres.index');
Route::get('/vendres/create', [vendreController::class, 'create'])->name('vendres.create');
Route::post('/vendres', [vendreController::class, 'store'])->name('vendres.store');
Route::put('/vendres/{vendre}', [vendreController::class, 'update'])->name('vendres.update');
Route::delete('/vendres/{vendre}', [vendreController::class, 'delete'])->name('vendres.delete');
Route::get('/vendres/{vendres}/edit', [vendreController::class, 'edit'])->name('vendres.edit');



});

require __DIR__.'/auth.php';
