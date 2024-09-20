<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\centroController;
use App\Http\Controllers\gruposController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\lineaController;
use App\Http\Controllers\log_auditoria;
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
    Route::get('index/redes/consultar_red', [redesController::class, 'showRedes']);
    Route::get('index/redes/showModalRegistrar', [redesController::class, 'showModalRegistrar']);
    Route::post('index/redes/crear_red', [redesController::class, 'registrarRed']);
    Route::get('index/redes/showModalActualizar', [redesController::class, 'showModalModificar']);
    Route::post('index/redes/actualizar_red', [redesController::class, 'actualizarRed']);

    //Gurpos de investigacion
    Route::get('index/grupos/consultar_grupos', [gruposController::class, 'showGrupos']);
    Route::get('index/grupos/showModalRegistrar', [gruposController::class, 'showModalRegistrar']);
    Route::post('index/grupos/registarGrupos', [gruposController::class, 'registrarGrupo']);
    Route::get('index/grupos/showModalActualizar', [gruposController::class, 'showModalModificar']);
    Route::post('index/grupos/actualizarGrupos', [gruposController::class, 'actualizarGrupo']);

    //Centros de investigacion
    Route::get('index/centros/consultar_centros', [centroController::class, 'showCentros']);
    Route::get('index/centros/showModalRegistrar', [centroController::class, 'showModalRegistrar']);
    Route::post('index/centros/registrarCentros', [centroController::class, 'registrarCentro']);
    Route::get('index/centros/showModalActualizar', [centroController::class, 'showModalModificar']);
    Route::post('index/centros/actualizarCentros', [centroController::class, 'actualizarCentro']);

    //Cargos
    Route::get('index/cargos/consultar_cargos', [cargoController::class, 'showCargos']);
    Route::get('index/cargos/crear_cargos', [cargoController::class, 'showModalRegistrar']);
    Route::post('index/cargos/registrarCargos', [cargoController::class, 'registrarCargo']);
    Route::get('index/cargos/editarLineas', [lineaController::class, 'showModificarCargo']);
    Route::post('index/cargos/actualizarCargo', [cargoController::class, 'actualizarCargo']);

    //Lineas de investigación
    Route::get('index/lineas/consultar_lineas', [lineaController::class, 'showLineas']);
    Route::get('index/lineas/crear_lineas', [lineaController::class, 'showModalRegistrar']);
    Route::post('index/lineas/registrarLineas', [lineaController::class, 'registrarLinea']);
    Route::get('index/lineas/editarLineas', [lineaController::class, 'showModificarLinea']);
    Route::post('index/lineas/actualizarLinea', [lineaController::class, 'actualizarLinea']);

    // Roles
    Route::get('index/roles/consultar_rol', [rolController::class, 'consultarRol']);
    Route::get('index/rol/permisoRol', [rolController::class, 'consultarPermiso']);
    Route::get('index/roles/funciones', [rolController::class, 'consultarFunciones']);
    Route::get('index/roles/showModalRegistrar', [rolController::class, 'showModalRegistrar']);
    Route::post('index/roles/crear_rol', [rolController::class, 'registrarRol']);
    Route::get('index/roles/showModalActualizar', [rolController::class, 'showModalActualizar']);
    Route::post('/roles/actualizar_rol', [rolController::class, 'actualizarRol']);

    //semilleros
    Route::get('index/semilleros/consultar_semillero', [semillerosController::class, 'showSemilleros']);
    Route::get('index/semilleros/showModalRegistrar', [semillerosController::class, 'showModalRegistrar']);
    Route::post('index/semilleros/crear_semillero', [semillerosController::class, 'registrarSemilleros']);
    Route::get('index/semilleros/showModalActualizar', [semillerosController::class, 'showModalActualizar']);
    Route::post('index/semilleros/actualizar_semillero', [semillerosController::class, 'actualizarSemilleros']);
    //Semilleros - Validacion
    Route::get('index/semilleros/showModalValidar', [semillerosController::class, 'showModalValidar']);
    Route::post('index/semilleros/validarUsuarios', [semillerosController::class, 'validarUsuarios']);
    //Auditoría

    Route::get('index/auditorias/consultar_auditorias', [log_auditoria::class, 'consultarAuditoria']);

    //Asignar rol

    Route::get('index/usuarios/asignar_rol', [usuarioController::class, 'showAsignarRol']);
    Route::get('index/usuarios/showModalAsignarRol', [usuarioController::class, 'showModalAsignarRol']);
    Route::post('index/usuarios/asignarRol', [usuarioController::class, 'asignarRol']);
});


Route::get('/logout', [AuthLoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('filter');
//Usuarios
Route::get('index/user/view_profile', [usuarioController::class, 'showPerfil']);


Route::get('logout', [AuthLoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('filter');
Route::post('/registrarUsuario', [usuarioController::class, 'registrarUsuario'])->middleware('filter');

Route::get('/get-municipios/{departamento_id}', [RegisterController::class, 'getMunicipiosByDepartamento'])->middleware('filter');
//Registro
Route::view('/registro', 'registro')->name('registro');
