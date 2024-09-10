
<?php

use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\lineaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\rolController;
use Illuminate\Support\Facades\Route;
use Illuminate\Controllers\RegisterController;
use App\Http\Controllers\semillerosController;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\redesController;
use App\Http\Controllers\gruposController;
use App\Http\Controllers\centroController;
use App\Http\Controllers\DepartamentosController;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'presentacion')->middleware('filter');
Route::view('/presentacion', 'presentacion');


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::middleware('filter')->group(function () {
        Route::middleware('checkPermisos')->group(function () {
            //Pagina de Bienvenida

            Route::get('/index', [inicioController::class, 'index']);


            //Gurpos de investigacion
            Route::get('index/grupos/consultar_grupos', [gruposController::class, 'showGrupos']);
            Route::get('index/grupos/showModalRegistrar', [gruposController::class, 'showModalRegistrar']);
            Route::post('index/grupos/registarGrupos', [gruposController::class, 'registrarGrupo']);
            Route::get('index/grupos/showModalActualizar', [gruposController::class, 'showModalActualizar']);
            Route::post('index/grupos/actualizarGrupos', [gruposController::class, 'actualizarGrupo']);

            //Centros de investigacion
            Route::get('index/centros/consultar_centros', [centroController::class, 'showCentros']);
            Route::get('index/centros/showModalRegistrar', [centroController::class, 'showModalRegistrar']);
            Route::post('index/centros/registarCentros', [centroController::class, 'registrarCentro']);
            Route::get('index/centros/showModalActualizar', [centroController::class, 'showModalActualizar']);
            Route::post('index/centros/actualizarCentros', [centroController::class, 'actualizarCentro']);

            //Cargos
            Route::get('index/cargos/consultar_cargos', [cargoController::class, 'showCargos']);
            Route::get('index/cargos/showModalRegistrar', [cargoController::class, 'showModalRegistrar']);
            Route::post('index/cargos/crear_cargos', [cargoController::class, 'registrarCargo']);
            Route::get('index/lineas/showModalActualizar', [lineaController::class, 'showModificarCargo']);
            Route::post('index/cargos/actualizarCargo', [cargoController::class, 'actualizarCargo']);

            //Lineas de investigación
            Route::get('index/lineas/consultar_lineas', [lineaController::class, 'showLineas']);
            Route::get('index/lineas/crear_lineas', [lineaController::class, 'showModalRegistrar']);
            Route::post('index/lineas/registrarLineas', [lineaController::class, 'registrarLinea']);
            Route::get('index/lineas/editarLineas', [lineaController::class, 'showModificarLinea']);
            Route::post('index/lineas/actualizarLinea', [lineaController::class, 'actualizarLinea']);

            // Roles
            Route::get('index/roles/consultar_roles', [rolController::class, 'consultarRol']);
            Route::get('index/roles/crear_rol', [rolController::class, 'showRegistrarRol']);
            Route::post('index/roles/registrarRol', [rolController::class, 'registrarRol']);
            // Route::get('/roles/editarRol/{id}', [rolController::class, 'editarRol']);
            Route::post('/roles/actualizarRol', [rolController::class, 'actualizarRol']);

            //Semilleros
            Route::get('/index/semilleros/consultar_semilleros', [semillerosController::class, 'consultarSemilleros']);
            Route::get('/index/semilleros/crear_semillero', [semillerosController::class, 'crearSemilleros']);
            Route::post('/semilleros/registrarSemilleros', [semillerosController::class, 'registrarSemillero']);
        });
    });
});

Route::get('/logout', [AuthLoginController::class, 'logout']);
Route::get('/register', [RegistroController::class, 'showRegistrationForm'])->middleware('filter');

Route::get('/get-municipios/{departamento_id}', [RegistroController::class, 'getMunicipiosByDepartamento'])->middleware('filter');

//

// Route::view('/register', 'auth/register')->name('register');
