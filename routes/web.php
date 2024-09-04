<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\centroController;
use App\Http\Controllers\gruposController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\lineaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\rolController;
use App\Http\Controllers\redesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'presentacion')->middleware('filter');
// ->middleware('checkPermisos');
// Route::view('/presentacion', 'presentacion');
Auth::routes();

Route::middleware('auth', 'filter', 'active', 'notifications', 'checkPermisos')->group(function () {

    //Pagina de Bienvenida
    Route::get('/index', [inicioController::class, 'index']);

    //Redes de Concocimiento
    Route::get('index/redes/consultar_red', [redesController::class, 'showRedes']);
    Route::get('index/redes/showModalRegistrar', [redesController::class, 'showModalRegistrar']);
    Route::post('index/redes/crear_red', [redesController::class, 'registrarRed']);
    Route::get('index/redes/showModalActualizar', [redesController::class, 'showModalModificar']);
    Route::post('index/redes/actualizarRedes', [redesController::class, 'actualizarRed']);

    //Gurpos de investigacion
    Route::get('index/grupos/consultar_grupos', [gruposController::class], 'showGrupos');
    Route::get('index/grupos/crear_grupos', [gruposController::class, 'showRegistrarGrupos']);
    Route::post('index/grupos/registarGrupos', [gruposController::class, 'registrarGrupo']);
    Route::post('index/grupos/actualizarGrupos', [gruposController::class, 'actualizarGrupo']);

    //Centros de investigacion
    Route::get('index/grupos/consultar_centros', [centroController::class], 'showCentros');
    Route::get('index/grupos/crear_centros', [centroController::class, 'showRegistrarCentros']);
    Route::post('index/grupos/registarCentros', [centroController::class, 'registrarCentro']);
    Route::post('index/grupos/actualizarCentros', [centroController::class, 'actualizarCentro']);

    //Cargos
    Route::get('index/cargos/consultar_cargo', [cargoController::class, 'showCargos']);
    Route::get('index/cargos/crear_cargos', [cargoController::class, 'showModalRegistrar']);
    Route::post('index/cargos/registrarCargos', [cargoController::class, 'registrarCargo']);
    Route::get('index/lineas/editarLineas', [lineaController::class, 'showModificarCargo']);
    Route::post('index/cargos/actualizarCargo', [cargoController::class, 'actualizarCargo']);

    //Lineas de investigación
    Route::get('index/lineas/consultar_lineas', [lineaController::class, 'showLineas']);
    Route::get('index/lineas/crear_lineas', [lineaController::class, 'showModalRegistrar']);
    Route::post('index/lineas/registrarLineas', [lineaController::class, 'registrarLinea']);
    Route::get('index/lineas/editarLineas', [lineaController::class, 'showModificarLinea']);
    Route::post('index/lineas/actualizarLinea', [lineaController::class, 'actualizarLinea']);

    // Roles
    Route::get('index/roles/consultar_rol', [rolController::class, 'consultarRol']);
    Route::get('index/roles/crearRol', [rolController::class, 'showRegistrarRol']);
    Route::post('index/roles/registrarRol', [rolController::class, 'registrarRol']);
    // Route::get('/roles/editarRol/{id}', [rolController::class, 'editarRol']);
    Route::post('/roles/actualizarRol', [rolController::class, 'actualizarRol']);
});

//Registro
Route::view('/registro', 'registro')->name('registro');
