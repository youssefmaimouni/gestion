<?php

use App\Http\Controllers\magazin;
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
 
Route::get('/magazins', [magazin::class, 'index'])->name('magazins.index');
Route::get('/magazins/create', [magazin::class, 'create'])->name('magazins.create');
Route::post('/magazins', [magazin::class, 'store'])->name('magazins.store');
Route::put('/magazins/{magazin}', [magazin::class, 'update'])->name('magazins.update');
Route::delete('/magazins/{magazin}', [magazin::class, 'delete'])->name('magazins.delete');
Route::get('/magazins/{magazins}/edit', [magazin::class, 'edit'])->name('magazins.edit'); 

});

require __DIR__.'/auth.php';
