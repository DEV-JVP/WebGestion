<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmandoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\GuiaController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\PerfilConfirmandoController;
use App\Http\Controllers\DocumentoController;
use Dom\Document;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});
Route::get('/documentos/export/csv', [DocumentoController::class, 'export'])
     ->name('documentos.export.csv');

 Route::resource('documentos', DocumentoController::class);
Route::get('confirmandos/{confirmando}/documentos/edit', [DocumentoController::class, 'edit'])->name('documentos.edit');
Route::put('confirmandos/{confirmando}/documentos', [DocumentoController::class, 'update'])->name('documentos.update');



// Rutas de Perfil (accesibles para cualquiera)
Route::get('perfil', [PerfilConfirmandoController::class, 'showForm'])->name('perfil.form');
Route::post('perfil', [PerfilConfirmandoController::class, 'search'])->name('perfil.search');
Route::get('/', [PerfilConfirmandoController::class, 'welcome'])->name('welcome');
Route::get('/buscar-confirmando', [ConfirmandoController::class, 'buscar'])->name('buscar.confirmando');


// Rutas protegidas por el middleware de autenticación de Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Módulos CRUD
    Route::resource('confirmandos', ConfirmandoController::class);
    Route::resource('jornadas', JornadaController::class);
    Route::resource('guias', GuiaController::class);


    // Rutas anidadas (pagos)
    Route::prefix('confirmandos/{confirmando}')->group(function () {
        Route::resource('pagos', PagoController::class);
    });

    // Rutas anidadas (asistencias)
    Route::prefix('jornadas/{jornada}')->group(function () {
        Route::get('asistencias/edit', [AsistenciaController::class, 'edit'])->name('asistencias.edit');
        Route::put('asistencias', [AsistenciaController::class, 'update'])->name('asistencias.update');
    });

    // Rutas de Comunidades
    Route::get('comunidades/designar', [ComunidadController::class, 'designar'])->name('comunidades.designar');
    Route::post('comunidades/designar', [ComunidadController::class, 'guardarDesignacion'])->name('comunidades.guardarDesignacion');
    Route::resource('comunidades', ComunidadController::class)->parameters([
        'comunidades' => 'comunidad'
    ]);
});