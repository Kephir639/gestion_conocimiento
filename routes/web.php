
<?php

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
            // // Roles
            // Route::get('/roles/consultarRol', [rolController::class, 'consultarRol']);
            // Route::get('/roles/crearRol', [rolController::class, 'showRegistrarRol']);
            // Route::post('/roles/registrar', [rolController::class, 'registrarRol']);
            // Roles
            Route::get('/index/roles/consultar_rol', [rolController::class, 'consultarRoles'])->name("roles.consultar");
            Route::get('/index/roles/crearRol', [rolController::class, 'showRegistrarRol']);
            Route::post('/index/roles/registrarRol', [rolController::class, 'registrarRol']);
            Route::get('/index/roles/editarRol/{id}', [rolController::class, 'editarRol']);
            Route::post('/index/roles/actualizarRol/{id}', [rolController::class, 'actualizarRol'])->name('roles.actualizarRol');
            
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
             
            // Route::view('/registro', 'registro')->name('registro');
            
            //Semilleros
            Route::get('/index/semilleros/consultar_semillero', [semillerosController::class, 'consultarSemilleros']);
            Route::get('/index/semilleros/crear_semillero', [semillerosController::class, 'crearSemilleros']);
            Route::post('/semilleros/registrarSemilleros', [semillerosController::class, 'registrarSemillero']);
        });
        
    });
});
Route::get('/register', [RegistroController::class, 'showRegistrationForm'])->middleware('filter');
  
Route::get('/get-municipios/{departamento_id}', [RegistroController::class, 'getMunicipiosByDepartamento'])->middleware('filter');

//  

// Route::view('/register', 'auth/register')->name('register');




