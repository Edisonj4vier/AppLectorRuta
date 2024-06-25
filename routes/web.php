<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppLectorRutaController;
use App\Http\Controllers\LecturaController;

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
Route::get('/app-lector-ruta', [AppLectorRutaController::class, 'index'])->name('app-lector-ruta.index');
Route::post('/app-lector-ruta', [AppLectorRutaController::class, 'store'])->name('app-lector-ruta.store');
Route::get('/app-lector-ruta/{id}/edit', [AppLectorRutaController::class, 'edit'])->name('app-lector-ruta.edit');
Route::put('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'update'])->name('app-lector-ruta.update');
Route::delete('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'destroy'])->name('app-lector-ruta.destroy');
Route::get('/lecturas', [LecturaController::class, 'index'])->name('lecturas.index');
// -------------

Route::get('/lecturas', [LecturaController::class, 'index'])->name('lecturas.index');

