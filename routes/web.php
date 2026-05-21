<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\controllerInicio;
use App\Http\Controllers\Panel\controllerPanel;
use App\Http\Controllers\Panel\controllerEmpresa;
use App\Http\Controllers\Panel\controllerTaller;
use App\Http\Controllers\Panel\controllerActividad;
use Illuminate\Support\Facades\Route;

Route::get('/empresa/buscar', [SearchController::class, 'show'])->name('empresaBuscar');
Route::get('/empresa/data', [SearchController::class, 'data'])->name('empresadata');
Route::get('/categoria/{slug}/buscar',[SearchController::class, 'categoria'])->name('categoriaBuscar');
Route::get('/categoria/{slug}/data',[SearchController::class, 'categoriaData'])->name('categoriaData');
Route::get('/ciudad/{id}/buscar', [SearchController::class, 'ciudadBuscar'])->name('ciudadBuscar');
Route::get('/ciudad/{id}/data',   [SearchController::class, 'ciudadData'])->name('ciudadData');

Route::post('codigo/{ci}', [controllerInicio::class, 'codigoUsuario'])->name('codigoUsuario');
Route::post('registrar/{codigo}', [controllerInicio::class, 'crearUsuario'])->name('crearUsuario');
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
});