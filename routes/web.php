<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('empresas', EmpresaController::class);

DB::table('empresas')->insert([
    'nombre' => 'Cafe felicidad',
    'descripcion' => 'Cafe en El Alto',
    'descuento' => 5.0
]);