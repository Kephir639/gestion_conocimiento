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
use App\Http\Controllers\semillerosController;
use App\Http\Controllers\usuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'presentacion')->middleware('filter');
// ->middleware('checkPermisos');
// Route::view('/presentacion', 'presentacion');
Auth::routes();

Route::middleware('auth', 'active', 'filter', 'notifications', 'checkPermisos')->group(function () {

    //Pagina de Bienvenida
    Route::get('/index', [inicioController::class, 'index']);

    //Redes de Concocimiento
    Route::get('index/redes/consultar_redes', [redesController::class, 'showRedes']);
    Route::get('index/redes/showModalRegistrar', [redesController::class, 'showModalRegistrar']);
    Route::post('index/redes/crear_redes', [redesController::class, 'registrarRed']);
    Route::get('index/redes/showModalActualizar', [redesController::class, 'showModalActualizar']);
    Route::post('index/redes/actualizar_redes', [redesController::class, 'actualizarRed']);

    //Gurpos de investigacion
    Route::get('index/grupos/consultar_grupos', [gruposController::class, 'showGrupos']);
    Route::get('index/grupos/showModalRegistrar', [gruposController::class, 'showModalRegistrar']);
    Route::post('index/grupos/registrarGrupos', [gruposController::class, 'registrarGrupo']);
    Route::get('index/grupos/showModalActualizar', [gruposController::class, 'showModalActualizar']);
    Route::post('index/grupos/actualizarGrupos', [gruposController::class, 'actualizarGrupo']);

    //Centros de investigacion
    Route::get('index/centros/consultar_centros', [centroController::class, 'showCentros']);
    Route::get('index/centros/showModalRegistrar', [centroController::class, 'showModalRegistrar']);
    Route::post('index/centros/registrarCentros', [centroController::class, 'registrarCentro']);
    Route::get('index/centros/showModalActualizar', [centroController::class, 'showModalActualizar']);
    Route::post('index/centros/actualizarCentro', [centroController::class, 'actualizarCentro']);

    //Cargos
    Route::get('index/cargos/consultar_cargos', [cargoController::class, 'showCargos']);
    Route::get('index/cargos/showModalRegistrar', [cargoController::class, 'showModalRegistrar']);
    Route::post('index/cargos/registrarCargos', [cargoController::class, 'registrarCargo']);
    Route::get('index/cargos/showModalActualizar', [cargoController::class, 'showModalActualizar']);
    Route::post('index/cargos/actualizarCargo', [cargoController::class, 'actualizarCargo']);

    //Lineas de investigacións
    Route::get('index/lineas/consultar_lineas', [lineaController::class, 'showLineas']);
    Route::get('index/lineas/showModalRegistrar', [lineaController::class, 'showModalRegistrar']);
    Route::post('index/lineas/registrarLineas', [lineaController::class, 'registrarLinea']);
    Route::get('index/lineas/showModalActualizar', [lineaController::class, 'showModalActualizar']);
    Route::post('index/lineas/actualizarLinea', [lineaController::class, 'actualizarLinea']);

    // Roles
    Route::get('index/roles/consultar_roles', [rolController::class, 'consultarRol']);
    Route::get('index/rol/permisoRol', [rolController::class, 'consultarPermiso']);
    Route::get('index/roles/funciones', [rolController::class, 'consultarFunciones']);
    Route::get('index/roles/showModalRegistrar', [rolController::class, 'showModalRegistrar']);
    Route::post('index/roles/registrarRol', [rolController::class, 'registrarRol']);
    Route::get('index/roles/showModalActualizar', [rolController::class, 'showModalActualizar']);
    Route::post('/roles/actualizarRol', [rolController::class, 'actualizarRol']);

    //semilleros
    Route::get('index/semilleros/consultar_semilleros', [semillerosController::class, 'showSemilleros']);
    Route::get('index/semilleros/showModalRegistrar', [semillerosController::class, 'showModalRegistrar']);
    Route::post('index/semilleros/registrarSemilleros', [semillerosController::class, 'registrarSemilleros']);
    Route::get('index/semilleros/showModalActualizar', [semillerosController::class, 'showModalActualizar']);
    Route::post('index/semilleros/actualizarSemilleros', [semillerosController::class, 'actualizarSemilleros']);

    Route::get('index/semilleros/showModalValidar', [semillerosController::class, 'showModalValidar']);
    Route::post('index/semilleros/validarUsuarios', [semillerosController::class, 'validarUsuarios']);

    Route::get('index/usuarios/ver_perfil', [usuarioController::class, 'showPerfil']);
});

Route::put('/logout', [AuthLoginController::class, 'logout']);

//Registro
Route::view('/registro', 'registro')->name('registro');
