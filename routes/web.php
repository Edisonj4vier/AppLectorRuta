<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppLectorRutaController;
<<<<<<< HEAD
use App\Http\Controllers\LecturaController;

=======
use App\Http\Controllers\AuthController;
>>>>>>> temp-branch
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
Route::get('/app-lector-ruta/{id}/edit', [AppLectorRutaController::class, 'edit'])->name('app-lector-ruta.edit');
Route::put('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'update'])->name('app-lector-ruta.update');
Route::delete('/app-lector-ruta/{id}', [AppLectorRutaController::class, 'destroy'])->name('app-lector-ruta.destroy');
<<<<<<< HEAD
Route::get('/lecturas', [LecturaController::class, 'index'])->name('lecturas.index');
// -------------

Route::get('/lecturas', [LecturaController::class, 'index'])->name('lecturas.index');

=======
// ---------Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// ---------Auth
Route::middleware(['auth.token'])->group(function () {
    Route::get('/app-lector-ruta', [AppLectorRutaController::class, 'index'])->name('app-lector-ruta.index');
    Route::post('/app-lector-ruta', [AppLectorRutaController::class, 'store'])->name('app-lector-ruta.store');
});
>>>>>>> temp-branch
