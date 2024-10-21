<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\centroController;
use App\Http\Controllers\gruposController;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\lineaController;
use App\Http\Controllers\proyectosInvestigacionController;
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

Route::middleware('auth', 'active', 'filter', 'checkRoutes', 'notifications', 'checkPermisos')->group(function () {

    //Pagina de Bienvenida
    Route::get('/index', [inicioController::class, 'index'])->withoutMiddleware('checkRoutes');

    //Redes de Concocimiento
    Route::get('index/redes/consultar_red', [redesController::class, 'showRedes']);
    Route::get('index/redes/showModalRegistrar', [redesController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/redes/crear_red', [redesController::class, 'registrarRed']);
    Route::get('index/redes/showModalActualizar', [redesController::class, 'showModalModificar'])->withoutMiddleware('checkRoutes');
    Route::post('index/redes/actualizar_red', [redesController::class, 'actualizarRed']);

    //Lineas
    Route::get('index/lineas/consultar_linea', [lineaController::class, 'showLineas']);
    Route::get('index/lineas/showModalRegistrar', [lineaController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/lineas/crear_linea', [lineaController::class, 'registrarLinea']);
    Route::get('index/lineas/showModalActualizar', [lineaController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/lineas/actualizar_linea', [lineaController::class, 'actualizarLinea']);

    //Gurpos de investigacion
    Route::get('index/grupos/consultar_grupo', [gruposController::class, 'showGrupos']);
    Route::get('index/grupos/showModalRegistrar', [gruposController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/grupos/crear_grupo', [gruposController::class, 'registrarGrupo']);
    Route::get('index/grupos/showModalActualizar', [gruposController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/grupos/actualizar_grupo', [gruposController::class, 'actualizarGrupo']);

    //Centros de investigacion
    Route::get('index/centros/consultar_centro', [centroController::class, 'showCentros']);
    Route::get('index/centros/showModalRegistrar', [centroController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/centros/crear_centro', [centroController::class, 'registrarCentro']);
    Route::get('index/centros/showModalActualizar', [centroController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/centros/actualizar_centro', [centroController::class, 'actualizarCentro']);

    //Cargos
    Route::get('index/cargos/consultar_cargo', [cargoController::class, 'showCargos']);
    Route::get('index/cargos/showModalRegistrar', [cargoController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/cargos/crear_cargo', [cargoController::class, 'registrarCargo']);
    Route::get('index/cargos/showModalActualizar', [cargoController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/cargos/actualizar_cargo', [cargoController::class, 'actualizarCargo']);

    // Roles
    Route::get('index/roles/consultar_rol', [rolController::class, 'consultarRol']);
    Route::get('index/rol/permisoRol', [rolController::class, 'consultarPermiso']);
    Route::get('index/roles/funciones', [rolController::class, 'consultarFunciones']);
    Route::get('index/roles/showModalRegistrar', [rolController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/roles/crear_rol', [rolController::class, 'registrarRol']);
    Route::get('index/roles/showModalActualizar', [rolController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('/roles/actualizar_rol', [rolController::class, 'actualizarRol']);

    //semilleros
    Route::get('index/semilleros/consultar_semilleros', [semillerosController::class, 'showSemilleros']);
    Route::get('index/semilleros/showModalRegistrar', [semillerosController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/semilleros/crear_semillero', [semillerosController::class, 'registrarSemilleros']);
    Route::get('index/semilleros/showModalVer', [semillerosController::class, 'verSemilleros']);
    Route::get('index/semilleros/showModalActualizar', [semillerosController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/semilleros/actualizar_semillero', [semillerosController::class, 'actualizarSemilleros']);
    //Semilleros - Validacion
    Route::get('index/semilleros/showModalValidar', [semillerosController::class, 'showModalValidar'])->withoutMiddleware('checkRoutes');
    Route::post('index/semilleros/validarUsuarios', [semillerosController::class, 'validarUsuarios']);

    //usuarios
    Route::get('index/usuarios/consultar_usuarios', [usuarioController::class, 'showUsuarios']);
    Route::get('index/usuarios/ver_perfil', [usuarioController::class, 'showPerfil']);
    Route::post('index/usuarios/change_profile', [usuarioController::class, 'actualizarPerfil']);
    Route::get('index/usuarios/exportar_usuarios', [usuarioController::class, 'usersExport'])->withoutMiddleware('checkRoutes');

    //Proyectos de Investigacion
    Route::get('index/proyectos_investigacion/consultar_proyecto_investigacion', [proyectosInvestigacionController::class, 'showProyectosInvestigativos']);
    Route::get('index/proyectos_investigacion/showModalRegistrar', [proyectosInvestigacionController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/proyectos_investigacion/crear_proyecto_investigacion', [proyectosInvestigacionController::class, 'registrarProyectoInvestigacion']);
    Route::get('index/proyectos_investigacion/showModalActualizar', [proyectosInvestigacionController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/proyectos_investigacion/actualizar_proyecto_investigacion', [proyectosInvestigacionController::class, 'actualizarProyectoInvestigacion']);
});

Route::get('logout', [AuthLoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('filter');
Route::post('/registrarUsuario', [usuarioController::class, 'registrarUsuario'])->middleware('filter');

Route::get('/get-municipios/{departamento_id}', [RegisterController::class, 'getMunicipiosByDepartamento'])->middleware('filter');
//Registro
Route::view('/registro', 'registro')->name('registro');
