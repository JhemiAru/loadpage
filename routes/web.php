<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\controllerInicio;
use App\Http\Controllers\Panel\controllerPanel;
use App\Http\Controllers\Panel\controllerEmpresa;
use App\Http\Controllers\Panel\controllerTaller;
use App\Http\Controllers\Panel\controllerActividad;
use App\Http\Controllers\Panel\controllerCategoria;
use App\Http\Controllers\Panel\controllerCiudad;
use App\Http\Controllers\Panel\controllerPais;
use App\Http\Controllers\Panel\controllerEquipo;
use App\Http\Controllers\Panel\controllerInstitucion;
use App\Http\Controllers\Panel\controllerUsuario;
use App\Http\Controllers\Panel\controllerGaleria;
use Illuminate\Support\Facades\Route;

Route::get('/empresa/buscar', [SearchController::class, 'show'])->name('empresaBuscar');
Route::get('/empresa/data', [SearchController::class, 'data'])->name('empresadata');
Route::get('/categoria/{slug}/buscar',[SearchController::class, 'categoria'])->name('categoriaBuscar');
Route::get('/categoria/{slug}/data',[SearchController::class, 'categoriaData'])->name('categoriaData');
Route::get('/ciudad/{id}/buscar', [SearchController::class, 'ciudadBuscar'])->name('ciudadBuscar');
Route::get('/ciudad/{id}/data',   [SearchController::class, 'ciudadData'])->name('ciudadData');

Route::post('codigo/{ci}', [controllerInicio::class, 'codigoUsuario'])->name('codigoUsuario');
Route::post('registrar/{codigo}', [controllerInicio::class, 'crearUsuario'])->name('registrarUsuario');
Route::get('registro/{codigo}', [controllerInicio::class, 'registroUsuario'])->name('registroUsuario');
Route::get('empresa/comision', [controllerInicio::class, 'comision'])->name('comision');
Route::get('empresa/{slug}', [controllerInicio::class, 'detalleEmpresa'])->name('detalleEmpresa');
Route::get('noticia', [controllerInicio::class, 'noticia'])->name('noticia');
Route::post('preregistro', [controllerInicio::class, 'preRegistro'])->name('preregistro');
Route::get('equipo', [controllerInicio::class, 'equipo'])->name('equipo');
Route::get('empresa', [controllerInicio::class, 'empresa'])->name('empresa');

Route::get('ciudad/{id}', [controllerInicio::class, 'ciudad'])->name('ciudad');
Route::get('categoria/{slug}', [controllerInicio::class, 'categoria'])->name('categoria');
Route::get('actividad', [controllerInicio::class, 'actividad'])->name('actividad');
Route::get('taller', [controllerInicio::class, 'talleres'])->name('taller');
Route::get('contacto', [controllerInicio::class, 'contactanos'])->name('contactanos');
Route::get('/', [controllerInicio::class, 'inicio'])->name('inicio');

// Envío de emails de la página principal
Route::post('suscribir', [controllerInicio::class, 'suscribir'])->name('suscribir');
Route::post('email_post', [controllerInicio::class, 'emailPost'])->name('email_post');

Route::post('log', [controllerPanel::class, 'log'])->name('log');
Route::get('logout', [controllerPanel::class, 'logout'])->name('logout');
Route::post('reset/password/save', [controllerInicio::class, 'passwordSave'])->name('passwordSave');
Route::get('reset/password/{codigo}', [controllerInicio::class, 'passwordReset'])->name('passwordReset');
Route::post('reset', [controllerInicio::class, 'emailReset'])->name('reset');

Route::middleware(['auth'])->prefix('panel')->group(function () {
    Route::get('inicio', [controllerPanel::class, 'startAdmin'])->name('start-a');
    Route::get('/institucion/editar', [controllerInstitucion::class, 'edit'])->name('editarInstitucion');
    Route::put('/institucion/actualizar', [controllerInstitucion::class, 'update'])->name('actualizarInstitucion');

    Route::get('/usuario/index', [controllerUsuario::class, 'index'])->name('indexUsuario');
    Route::get('/usuario/crear', [controllerUsuario::class, 'create'])->name('crearUsuario');
    Route::post('/usuario/guardar', [controllerUsuario::class, 'store'])->name('guardarUsuario');
    Route::get('/usuario/{usuario}/editar', [controllerUsuario::class, 'edit'])->name('editarUsuario');
    Route::put('/usuario/{usuario}', [controllerUsuario::class, 'update'])->name('actualizarUsuario');
    Route::delete('/usuario/{usuario}', [controllerUsuario::class, 'destroy'])->name('eliminarUsuario');
    Route::patch('/usuario/{usuario}/toggle-activo', [controllerUsuario::class, 'toggleActivo'])->name('toggleActivoUsuario');

    Route::get('taller/index', [controllerTaller::class, 'index'])->name('indexTaller');
    Route::get('taller/crear', [controllerTaller::class, 'create'])->name('crearTaller');
    Route::post('taller/guardar', [controllerTaller::class, 'store'])->name('guardarTaller');
    Route::get('taller/{taller}/editar', [controllerTaller::class, 'edit'])->name('editarTaller');    
    Route::put('taller/{taller}', [controllerTaller::class, 'update'])->name('actualizarTaller');
    Route::delete('taller/{taller}', [controllerTaller::class, 'destroy'])->name('eliminarTaller');

    Route::get('empresa/index', [controllerEmpresa::class, 'index'])->name('indexEmpresa'); 
    Route::get('empresa/crear', [controllerEmpresa::class, 'create'])->name('crearEmpresa');
    Route::post('empresa/guardar', [controllerEmpresa::class, 'store'])->name('guardarEmpresa');
    Route::get('empresa/{empresa}/editar', [controllerEmpresa::class, 'edit'])->name('editarEmpresa');    
    Route::put('empresa/{empresa}', [controllerEmpresa::class, 'update'])->name('actualizarEmpresa');
    Route::delete('empresa/{empresa}', [controllerEmpresa::class, 'destroy'])->name('eliminarEmpresa');
    Route::patch('empresas/{empresa}/toggle-activo', [controllerEmpresa::class, 'toggleActivo'])->name('toggleActivoEmpresa');
    Route::patch('empresas/{empresa}/toggle-destacado', [controllerEmpresa::class, 'toggleDestacado'])->name('toggleDestacadoEmpresa');
    Route::patch('empresas/{empresa}/toggle-aliadas', [controllerEmpresa::class, 'toggleAliadas'])->name('toggleAliadasEmpresa');
    Route::patch('empresas/{empresa}/toggle-comision', [controllerEmpresa::class, 'toggleComision'])->name('toggleComisionEmpresa');

    Route::get('actividad/index', [controllerActividad::class, 'index'])->name('indexActividad'); 
    Route::get('actividad/crear', [controllerActividad::class, 'create'])->name('crearActividad');
    Route::post('actividad/guardar', [controllerActividad::class, 'store'])->name('guardarActividad');
    Route::get('actividad/{actividad}/editar', [controllerActividad::class, 'edit'])->name('editarActividad');    
    Route::put('actividad/{actividad}', [controllerActividad::class, 'update'])->name('actualizarActividad');
    Route::delete('actividad/{actividad}', [controllerActividad::class, 'destroy'])->name('eliminarActividad');
    Route::patch('actividads/{actividad}/toggle-activo', [controllerActividad::class, 'toggleActivo'])->name('toggleActivoActividad');

    Route::get('/categorias', [controllerCategoria::class, 'index'])->name('indexCategoria');
    Route::get('/categorias/crear', [controllerCategoria::class, 'create'])->name('crearCategoria');
    Route::post('/categorias', [controllerCategoria::class, 'store'])->name('guardarCategoria');
    Route::get('/categorias/{categoria}/editar', [controllerCategoria::class, 'edit'])->name('editarCategoria');
    Route::put('/categorias/{categoria}', [controllerCategoria::class, 'update'])->name('actualizarCategoria');
    Route::delete('/categorias/{categoria}', [controllerCategoria::class, 'destroy'])->name('eliminarCategoria');

    Route::get('/ciudades', [controllerCiudad::class, 'index'])->name('indexCiudad');
    Route::get('/ciudades/crear', [controllerCiudad::class, 'create'])->name('crearCiudad');
    Route::post('/ciudades', [controllerCiudad::class, 'store'])->name('guardarCiudad');
    Route::get('/ciudades/{ciudad}/editar', [controllerCiudad::class, 'edit'])->name('editarCiudad');
    Route::put('/ciudades/{ciudad}', [controllerCiudad::class, 'update'])->name('actualizarCiudad');
    Route::delete('/ciudades/{ciudad}', [controllerCiudad::class, 'destroy'])->name('eliminarCiudad');

    Route::get('/paises', [controllerPais::class, 'index'])->name('indexPais');
    Route::get('/paises/crear', [controllerPais::class, 'create'])->name('crearPais');
    Route::post('/paises', [controllerPais::class, 'store'])->name('guardarPais');
    Route::get('/paises/{pai}/editar', [controllerPais::class, 'edit'])->name('editarPais');
    Route::put('/paises/{pai}', [controllerPais::class, 'update'])->name('actualizarPais');
    Route::delete('/paises/{pai}', [controllerPais::class, 'destroy'])->name('eliminarPais');

    Route::get('/equipo', [controllerEquipo::class, 'index'])->name('indexEquipo');
    Route::get('/equipo/crear', [controllerEquipo::class, 'create'])->name('crearEquipo');
    Route::post('/equipo', [controllerEquipo::class, 'store'])->name('guardarEquipo');
    Route::get('/equipo/{equipo}/editar', [controllerEquipo::class, 'edit'])->name('editarEquipo');
    Route::put('/equipo/{equipo}', [controllerEquipo::class, 'update'])->name('actualizarEquipo');
    Route::delete('/equipo/{equipo}', [controllerEquipo::class, 'destroy'])->name('eliminarEquipo');
    Route::patch('/equipo/{equipo}/toggle-estado', [controllerEquipo::class, 'toggleEstado'])->name('toggleEstadoEquipo');

    Route::prefix('galeria')->group(function () {
        Route::get('/', [controllerGaleria::class, 'index'])->name('indexGaleria');
        Route::put('/editar', [controllerGaleria::class, 'editar'])->name('editarGaleria');
        Route::delete('/eliminar', [controllerGaleria::class, 'eliminar'])->name('eliminarGaleria');
        Route::post('/actualizar', [controllerGaleria::class, 'upload'])->name('actualizarGaleria');
    });
});