<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppLectorRutaController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\LecturaController;
use App\Http\Controllers\AuthController;

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
/*
Route::get('/app-lector-ruta', [AppLectorRutaController::class, 'index'])->name('app-lector-ruta.index');
Route::post('/app-lector-ruta', [AppLectorRutaController::class, 'store'])->name('app-lector-ruta.store');
Route::get('/app-lector-ruta/{id}/edit', [AppLectorRutaController::class, 'edit'])->name('app-lector-ruta.edit');
Route::put('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'update'])->name('app-lector-ruta.update');
// Route::delete('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'destroy'])->name('app-lector-ruta.destroy');


Route::middleware(['auth'])->group(function () {

    Route::post('/app-lector-ruta', [RutaController::class, 'store'])->name('app-lector-ruta.store');
    Route::delete('/app-lector-ruta/{id}', [RutaController::class, 'destroy'])->name('app-lector-ruta.destroy');
    // Agrega las rutas para edit y update si son necesarias
});
*/
//Route::get('/app-lector-ruta', [RutaController::class, 'index'])->name('app-lector-ruta.index');
Route::get('/lecturas', [LecturaController::class, 'index'])->name('lecturas.index');
Route::put('/lecturas/{id}', [LecturaController::class, 'update'])->name('lecturas.update');
Route::delete('/lecturas/{id}', [LecturaController::class, 'destroy'])->name('lecturas.destroy');
// -------------
// Route::get('/lecturas', [LecturaController::class, 'getData']);
// Route::get('/lecturas', [LecturaController::class, 'index'])->name('lecturas.index');
// ------------- Authorized Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Rutas protegidas
Route::get('/app-lector-ruta', [AppLectorRutaController::class, 'index'])->name('app-lector-ruta.index');
Route::middleware(['auth'])->group(function () {

    Route::post('/app-lector-ruta', [AppLectorRutaController::class, 'store'])->name('app-lector-ruta.store');
    Route::put('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'update'])->name('app-lector-ruta.update');
    Route::delete('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'destroy'])->name('app-lector-ruta.destroy');
});

/*
Route::get('/app-lector-ruta', [AppLectorRutaController::class, 'index'])->name('app-lector-ruta.index');
Route::post('/app-lector-ruta', [AppLectorRutaController::class, 'store'])->name('app-lector-ruta.store');
Route::delete('/app-lector-ruta', [AppLectorRutaController::class, 'destroy'])->name('app-lector-ruta.destroy');
Route::get('/app-lector-ruta/lectura', [AppLectorRutaController::class, 'getRutaLectura'])->name('app-lector-ruta.getRutaLectura');
Route::post('/app-lector-ruta/asignar', [AppLectorRutaController::class, 'asignarRuta'])->name('app-lector-ruta.asignarRuta');

*/
