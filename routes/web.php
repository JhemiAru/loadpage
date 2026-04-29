<?php

use Illuminate\Support\Facades\Route;

Route::get('/empresa/buscar', [\App\Http\Controllers\SearchController::class, 'show'])->name('empresaBuscar');
Route::get('/empresa/data', [\App\Http\Controllers\SearchController::class, 'data'])->name('empresadata');
Route::get('/categoria/{slug}/buscar',[\App\Http\Controllers\SearchController::class, 'categoria'])->name('categoriaBuscar');
Route::get('/categoria/data/{slug}',[\App\Http\Controllers\SearchController::class, 'categoriaData'])->name('categoriaData');

Route::post('codigo/{ci}', [\App\Http\Controllers\controllerInicio::class, 'codigoUsuario'])->name('codigoUsuario');
Route::post('registrar/{codigo}', [\App\Http\Controllers\controllerInicio::class, 'crearUsuario'])->name('crearUsuario');
Route::get('registro/{codigo}', [\App\Http\Controllers\controllerInicio::class, 'registroUsuario'])->name('registroUsuario');
Route::get('empresa/comision', [\App\Http\Controllers\controllerInicio::class, 'comision'])->name('comision');
Route::get('empresa/{slug}', [\App\Http\Controllers\controllerInicio::class, 'detalleEmpresa'])->name('detalleEmpresa');
Route::get('noticia', [\App\Http\Controllers\controllerInicio::class, 'noticia'])->name('noticia');
Route::post('preregistro', [\App\Http\Controllers\controllerInicio::class, 'preRegistro'])->name('preregistro');
Route::get('equipo', [\App\Http\Controllers\controllerInicio::class, 'equipo'])->name('equipo');
Route::get('empresa', [\App\Http\Controllers\controllerInicio::class, 'empresa'])->name('empresa');

Route::get('ciudad/{id}', [\App\Http\Controllers\controllerInicio::class, 'ciudad'])->name('ciudad');
Route::get('categoria/{slug}', [\App\Http\Controllers\controllerInicio::class, 'categoria'])->name('categoria');
Route::get('actividad', [\App\Http\Controllers\controllerInicio::class, 'actividad'])->name('actividad');
Route::get('taller', [\App\Http\Controllers\controllerInicio::class, 'talleres'])->name('taller');
Route::get('contacto', [\App\Http\Controllers\controllerInicio::class, 'contactanos'])->name('contactanos');
Route::get('/', [\App\Http\Controllers\controllerInicio::class, 'inicio'])->name('inicio');

// Envío de emails de la página principal
Route::post('suscribir', [\App\Http\Controllers\controllerInicio::class, 'suscribir'])->name('suscribir');
Route::post('email_post', [\App\Http\Controllers\controllerInicio::class, 'emailPost'])->name('email_post');