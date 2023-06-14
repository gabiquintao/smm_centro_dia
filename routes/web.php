<?php

use App\Http\Controllers\UtenteController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/documentos-solicitados', function () {
        return view('documentos-solicitados');
    })->name('documentos-solicitados');

    Route::get('/utentes', function () {
        return view('utentes');
    })->name('utentes');

    Route::get('/utentes/create', function () {
        return view('utentes.create');
    })->name('utentes.create');

    Route::get('/utentes/{utente}', [UtenteController::class, 'show'])->name('utentes.show');
    Route::get('/utentes/{utente}/edit', [UtenteController::class, 'edit'])->name('utentes.edit');
});
