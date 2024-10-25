<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\centroController;
use App\Http\Controllers\gruposController;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\lineaController;
use App\Http\Controllers\log_auditoria;
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
    Route::get('index/redes/consultar_redes', [redesController::class, 'showRedes']);

    Route::get('index/redes/showModalRegistrar', [redesController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/redes/crear_redes', [redesController::class, 'registrarRed']);

    Route::get('index/redes/showModalActualizar', [redesController::class, 'showModalModificar'])->withoutMiddleware('checkRoutes');
    Route::post('index/redes/actualizar_redes', [redesController::class, 'actualizarRed']);

    //Lineas
    Route::get('index/lineas/consultar_lineas', [lineaController::class, 'showLineas']);

    Route::get('index/lineas/showModalRegistrar', [lineaController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/lineas/crear_lineas', [lineaController::class, 'registrarLinea']);

    Route::get('index/lineas/showModalActualizar', [lineaController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/lineas/actualizar_lineas', [lineaController::class, 'actualizarLinea']);

    //Gurpos de investigacion
    Route::get('index/grupos/consultar_grupos', [gruposController::class, 'showGrupos']);

    Route::get('index/grupos/showModalRegistrar', [gruposController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/grupos/crear_grupos', [gruposController::class, 'registrarGrupo']);

    Route::get('index/grupos/showModalActualizar', [gruposController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/grupos/actualizar_grupos', [gruposController::class, 'actualizarGrupo']);

    //Centros de investigacion
    Route::get('index/centros/consultar_centros', [centroController::class, 'showCentros']);

    Route::get('index/centros/showModalRegistrar', [centroController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/centros/crear_centros', [centroController::class, 'registrarCentro']);

    Route::get('index/centros/showModalActualizar', [centroController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/centros/actualizar_centros', [centroController::class, 'actualizarCentro']);

    //Cargos
    Route::get('index/cargos/consultar_cargos', [cargoController::class, 'showCargos']);

    Route::get('index/cargos/showModalRegistrar', [cargoController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/cargos/crear_cargos', [cargoController::class, 'registrarCargo']);

    Route::get('index/cargos/showModalActualizar', [cargoController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/cargos/actualizar_cargos', [cargoController::class, 'actualizarCargo']);

    // Roles
    Route::get('index/roles/consultar_roles', [rolController::class, 'consultarRol']);
    Route::get('index/roles/permisoRol', [rolController::class, 'consultarPermiso'])->withoutMiddleware('checkRoutes');
    Route::get('index/roles/funciones', [rolController::class, 'consultarFunciones'])->withoutMiddleware('checkRoutes');

    Route::get('index/roles/showModalRegistrar', [rolController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/roles/crear_roles', [rolController::class, 'registrarRol']);

    Route::get('index/roles/showModalActualizar', [rolController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('/roles/actualizar_roles', [rolController::class, 'actualizarRol']);

    //semilleros    
    Route::get('index/semilleros/consultar_semilleros', [SemillerosController::class, 'showSemilleros']);
    Route::get('index/semilleros/showModalVer', [SemillerosController::class, 'verSemilleros'])->withoutMiddleware('checkRoutes');
    Route::get('index/semilleros/showModalRegistrar', [SemillerosController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/semilleros/crear_semillero', [SemillerosController::class, 'registrarSemilleros']);
    Route::get('index/semilleros/showModalActualizar', [SemillerosController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/semilleros/actualizar_semillero', [SemillerosController::class, 'actualizarSemilleros']);
    //Semilleros - Validacion
    Route::get('index/semilleros/showModalValidar', [semillerosController::class, 'showModalValidar'])->withoutMiddleware('checkRoutes');
    Route::post('index/semilleros/validarUsuarios', [semillerosController::class, 'validarUsuarios']);

    //usuarios - Perfil
    Route::get('index/usuarios/consultar_usuarios', [usuarioController::class, 'showUsuarios']);
    Route::get('index/usuarios/showModalActualizar', [usuarioController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/usuarios/actualizar_usuarios', [usuarioController::class, 'editarUsuario'])->withoutMiddleware('filter');
    Route::get('index/usuarios/exportar_usuarios', [usuarioController::class, 'usersExport'])->withoutMiddleware('checkRoutes');

    //Perfil
    Route::get('index/usuarios/ver_perfil', [usuarioController::class, 'showPerfil'])->withoutMiddleware('checkRoutes');
    Route::post('index/usuarios/actualizar_perfil', [usuarioController::class, 'actualizarPerfil']);

    Route::get('index/usuarios/asignar_roles', [usuarioController::class, 'showAsignarRol']);
    Route::get('index/usuarios/showModalAsignarRol', [usuarioController::class, 'showModalAsignarRol'])->withoutMiddleware('checkRoutes');
    Route::post('index/usuarios/asignarRol', [usuarioController::class, 'asignarRol'])->withoutMiddleware('checkRoutes');

    //Proyectos de Investigacion
    Route::get('index/proyectos_investigacion/consultar_proyectos_investigacion', [proyectosInvestigacionController::class, 'showProyectosInvestigativos'])->withoutMiddleware('checkRoutes');;
    Route::get('index/proyectos_investigacion/showModalRegistrar', [proyectosInvestigacionController::class, 'showModalRegistrar'])->withoutMiddleware('checkRoutes');
    Route::post('index/proyectos_investigacion/crear_proyecto_investigacion', [proyectosInvestigacionController::class, 'registrarProyectoInvestigacion']);
    Route::get('index/proyectos_investigacion/showModalActualizar', [proyectosInvestigacionController::class, 'showModalActualizar'])->withoutMiddleware('checkRoutes');
    Route::post('index/proyectos_investigacion/actualizar_proyecto_investigacion', [proyectosInvestigacionController::class, 'actualizarProyectoInvestigacion']);

    Route::get('index/proyectos_investigacion/agregar_actividad', [proyectosInvestigacionController::class, 'agregarActividad'])->withoutMiddleware('checkRoutes');
    Route::get('index/proyectos_investigacion/agregar_presupuesto', [proyectosInvestigacionController::class, 'agregarPresupuesto'])->withoutMiddleware('checkRoutes');

    //Auditoria
    Route::get('index/auditorias/consultar_auditorias', [log_auditoria::class, 'showLog']);
});

Route::get('logout', [AuthLoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('filter');
Route::post('/registrarUsuario', [usuarioController::class, 'registrarUsuario'])->middleware('filter');

Route::get('/get-municipios/{departamento_id}', [RegisterController::class, 'getMunicipiosByDepartamento'])->middleware('filter');
Route::get('/get-municipios/{departamento_id}', [usuarioController::class, 'getMunicipiosByDepartamento'])->middleware('filter');
//Registro
Route::view('/registro', 'registro')->name('registro');
