<?php

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

Route::middleware('auth')->group(function () {
    Route::middleware('filter')->group(function () {
        Route::middleware('checkPermisos')->group(function () {
            //Pagina de Bienvenida
            Route::get('/index', [inicioController::class, 'index']);

            //Redes de Concocimiento
            Route::get('index/redes/consultar_red', [redesController::class, 'showRedes'])->middleware('checkPermisos');
            Route::get('index/redes/showModalRegistrar', [redesController::class, 'showModalRegistrar']);
            Route::post('index/redes/registrarRedes', [redesController::class, 'registrarRed']);
            Route::get('index/redes/showModalActualizar', [redesController::class, 'showModalModificar']);
            Route::post('index/redes/actualizarRedes', [redesController::class, 'actualizarRed']);
            //Gurpos de investigacion
            Route::get('index/grupos/consultar_grupos', [gruposController::class], 'showGrupos');
            Route::get('index/grupos/crear_grupos', [gruposController::class, 'showRegistrarGrupos']);
            Route::post('index/grupos/registarGrupos', [gruposController::class, 'registrarGrupo']);
            Route::post('index/grupos/actualizarGrupos', [gruposController::class, 'actualizarGrupo']);

            //Centros de investigacion
            Route::get('index/grupos/consultarCentros', [centroController::class], 'showCentros');
            Route::get('index/grupos/crearCentros', [centroController::class, 'showRegistrarCentros']);
            Route::post('index/grupos/registarCentros', [centroController::class, 'registrarCentro']);
            Route::post('index/grupos/actualizarCentros', [centroController::class, 'actualizarCentro']);
        });
    });
});

// Roles
Route::get('/roles/consultarRol', [rolController::class, 'consultarRol'])->name("roles.consultar");
Route::get('/roles/crearRol', [rolController::class, 'showRegistrarRol']);
Route::post('/roles/registrarRol', [rolController::class, 'registrarRol']);
Route::get('/roles/editarRol/{id}', [rolController::class, 'editarRol']);
Route::post('/roles/actualizarRol/{id}', [rolController::class, 'actualizarRol'])->name('roles.actualizarRol');

//Cargos
Route::get('/cargos/consultarCargo', [cargoController::class, 'consultarCargo'])->name("cargos.consultar");
Route::get('/cargos/crearCargo', [cargoController::class, 'showregistrarCargo']);
Route::post('/cargos/registrarCargos', [cargoController::class, 'registrarCargo']);
Route::get('/cargos/editarCargo/{id}', [cargoController::class, 'editarCargo']);
Route::post('/cargos/actualizarCargo/{id}', [cargoController::class, 'actualizarCargo'])->name('cargo.actualizarCargo');

//Lineas de investigación
Route::get('/lineas/consultarLineas', [lineaController::class, 'consultarLineas'])->name("linea.consultar");
Route::get('/lineas/crearLineas', [lineaController::class, 'showregistrarLineas']);
Route::post('/lineas/registrarLineas', [lineaController::class, 'registrarLinea']);
Route::get('/lineas/editarLineas/{id}', [lineaController::class, 'editarLinea']);
Route::post('/lineas/actualizarLinea/{id}', [lineaController::class, 'actualizarLinea'])->name('linea.actualizarLinea');



//Registro
Route::view('/registro', 'registro')->name('registro');






// Home
// Route::get('/home', [HomeController::class, 'showHome'])->name('home');
// Route::middleware(['isLoggedIn'])->group(function () {
//     Route::get('/home', [HomeController::class, 'showHome'])->name('home');
//     Route::get('/home', [HomeController::class, 'showHome'])->name('home');
//     Route::get('/home/usuarios', [HomeController::class, 'showUsuarios']);
//     Route::post('/home/usuarios/asignarRol', [HomeController::class, 'asignarRol']);
//     Route::post('/home/usuarios/consultarUsuario', [HomeController::class, 'consultarUsuario']);
//     Route::get('/home/semilleros/crear', function () {
//         return view('crearSemilleros');
//     });
//     Route::post('/home/semilleros/crear', function () {
//         return view('crearSemilleros');
//     });
// });

Route::get('ejemplo', function () {
    return view('ejemplo');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
