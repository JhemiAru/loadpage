-- Alterar la tabla de categotias para poner iconos con el siguiente SLQ:

ALTER TABLE categorias 
ADD COLUMN icono VARCHAR(100) NULL AFTER imagen;

-- Luego agregar lso iconos con: 

UPDATE categorias SET icono = 'fas fa-futbol' 
WHERE slug = 'entretenimiento-y-deporte';

UPDATE categorias SET icono = 'fas fa-utensils' 
WHERE slug = 'restaurantes-y-snacks';

UPDATE categorias SET icono = 'fas fa-graduation-cap' 
WHERE slug = 'educacion-y-formacion';

UPDATE categorias SET icono = 'fas fa-heartbeat' 
WHERE slug = 'salud-y-centros-medicos';

UPDATE categorias SET icono = 'fas fa-car' 
WHERE slug = 'transporte-construccion-inmobiliarias';

UPDATE categorias SET icono = 'fas fa-briefcase' 
WHERE slug = 'servicios-profesionales-tecnicos';

UPDATE categorias SET icono = 'fas fa-tshirt' 
WHERE slug = 'ropa-y-accesorios';

UPDATE categorias SET icono = 'fas fa-box' 
WHERE slug = 'productos';

UPDATE categorias SET icono = 'fas fa-hotel' 
WHERE slug = 'hospedaje-y-turismo';

UPDATE categorias SET icono = 'fas fa-microphone-alt' 
WHERE slug = 'artistas-y-medios-de-comunicacion';

UPDATE categorias SET icono = 'fas fa-handshake' 
WHERE slug = 'instituciones-aliadas';

UPDATE categorias SET icono = 'fas fa-paw' 
WHERE slug = 'mascotas-y-servicios-veterinarios';

UPDATE categorias SET icono = 'fas fa-spa' 
WHERE slug = 'servicios-de-belleza-e-imagen-personal';

-- Editar tabla empresas para quitar duplicidad de ciudad La Paz:

UPDATE empresas
SET ciudad_id = 1
WHERE ciudad_id = 15;

DELETE FROM ciudads
WHERE id = 15;

-- Insertar por el momento solo número de celular del area comercial:

INSERT INTO institucions (
    qSomos,
    frase1,
    frase2,
    frase3,
    trabaja,
    desEmpresa,
    direccion,
    celular,
    telefono,
    email,
    facebook,
    twitter,
    youtube,
    instagram,
    google,
    imagen,
    vision,
    mision,
    banner1,
    banner2,
    banner3,
    titulonoticias,
    desnoticias,
    tituloactividades,
    desactividades,
    imgtrabaja,
    titulosomos,
    titulosuscribir,
    dessuscribir,
    titulotrabaja,
    tituloplan,
    desplan,
    nombreplan,
    bsprecio,
    susprecio,
    plan,
    benplan1,
    benplan2,
    benplan3,
    benplan4,
    benplan5,
    tituloequipo,
    desequipo,
    tituloempresa,
    visitas,
    created_at,
    updated_at
) VALUES (
    'Informacion para tarjeta',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '77793217',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    '_',
    0,
    NOW(),
    NOW()
);

-- Crear la tabla tallers
CREATE TABLE `tallers` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(255) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `fecha` DATE NOT NULL,
    `horario` VARCHAR(255) NOT NULL,
    `lugar` VARCHAR(500) NOT NULL,
    `imagen` VARCHAR(255) DEFAULT NULL,
    `costo` DECIMAL(10,2) NOT NULL,
    `detalles` TEXT,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tallers` (
    `titulo`, 
    `descripcion`, 
    `fecha`, 
    `horario`, 
    `lugar`, 
    `imagen`, 
    `costo`, 
    `detalles`, 
    `created_at`, 
    `updated_at`
) VALUES (
    'Taller de Hacking Ético y Ciberseguridad',
    'Aprende las técnicas más avanzadas de hacking ético para proteger sistemas informáticos. Curso práctico con ejemplos reales.',
    '2026-04-24',
    'de 9:00 a 13:00 y 14:00 a 18:00',
    'El Alto, Zona Ballivian, Av. Chacaltaya #50, Zona Alto Lima 1ra. Sección.',
    'taller_hacking.jpg',
    50.00,
    '{"requisitos": "Conocimientos básicos de redes", "incluye": "Certificado de participación, material digital, refrigerio", "cupo": "150 personas", "instructor": "Ing. Carlos Mamani", "nivel": "Intermedio"}',
    NOW(),
    NOW()
);

INSERT INTO `tallers` (
    `titulo`, 
    `descripcion`, 
    `fecha`, 
    `horario`, 
    `lugar`, 
    `imagen`, 
    `costo`, 
    `detalles`, 
    `created_at`, 
    `updated_at`
) VALUES (
    'Taller de Mantenimiento Preventivo y Correctivo de Computadoras',
    'Aprende a diagnosticar, reparar y mantener equipos computacionales. Curso totalmente práctico con equipos reales.',
    '2026-03-27',
    'de 9:00 a 13:00 y 14:00 a 18:00',
    'El Alto, Zona Ballivian, Av. Chacaltaya #50, Zona Alto Lima 1ra. Sección.',
    'taller_mantenimiento.jpg',
    50.00,
    '{"requisitos": "No se requiere experiencia previa", "incluye": "Kit de herramientas básicas, manual digital, certificado", "cupo": "25 personas", "instructor": "Tec. Juan Pérez", "nivel": "Básico-Intermedio", "materiales": "Se proporcionan equipos para práctica"}',
    NOW(),
    NOW()
);

-- Cambiar extensiones de las imagenes en la bd
--UPDATE empresas
-- SET imagen = REGEXP_REPLACE(LOWER(imagen), '\.(jpg|jpeg|png|gif|jfif)$', '.webp');
-- UPDATE empresas
-- SET imagen1 = REGEXP_REPLACE(LOWER(imagen1), '\.(jpg|jpeg|png|gif|jfif)$', '.webp');

UPDATE empresas 
SET imagen = REGEXP_REPLACE(imagen, '(?i)\\.(jpg|jpeg|png|gif|jfif)$', '.webp');

UPDATE empresas 
SET imagen1 = REGEXP_REPLACE(imagen1, '(?i)\\.(jpg|jpeg|png|gif|jfif)$', '.webp');

-- cambiar twitter a tiktok
ALTER TABLE `institucions` CHANGE `twitter` `tiktok` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;

UPDATE institucions 
SET tiktok = 'https://www.tiktok.com/@facebolsrl' 
WHERE id = 1;

<?php

use App\Http\Controllers\AjusteHoraController;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReporteActividadController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;

//Route::get('/', function () { return view('index'); })->middleware('auth');
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth')->name('index');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes(['register' => false]);


Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
})->middleware('web'); // Asegúrate de usar el middleware web

Route::get('/check-session', function () {
    return response()->json(['status' => 'active']);
})->middleware('web');


/* Route::get('/', function () {
    return view('welcome');
}); */

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

dddddd

// Guardar los cambios en la base de datos
Route::put('/reporteactividad/{id}', [ReporteActividadController::class, 'actualizarActividad'])->name('reporteactividad.actualizar');
// Eliminar una actividad
Route::delete('/eliminar-actividad/{id}', [ReporteActividadController::class, 'eliminarActividad'])->name('eliminarActividad');
// Reporte actividad pdf
Route::get('/reporteactividad/{id}/pdf', [ReporteActividadController::class, 'generarPdf'])->name('reporteactividad.pdf');
// enviar informe por correo
Route::post('/enviar-informe/{id}', [ReporteActividadController::class, 'enviarInforme'])->name('enviar.informe');

/* Route::resource('/reporteactividades', \App\Http\Controllers\ReporteActividadController::class); */
/* Route::get('/reporteactividad/{id}/usuario', [ReporteActividadController::class, 'mostrarUsuarioDeReporte'])->name('reporteactividad.mostrarUsuario'); */


/* Route::get('/asistencias/{id}', [AsistenciaController::class, 'show'])->name('asistencias.show'); */


Route::resource('/multas', \App\Http\Controllers\MultaController::class)->middleware('can:multas');

Route::resource('/actividads', \App\Http\Controllers\ActividadController::class)->middleware('can:actividads');

Route::resource('/programas', \App\Http\Controllers\ProgramaController::class)->middleware('can:programas');

Route::resource('/detalles', \App\Http\Controllers\DetalleController::class)->middleware('can:detalles');

Route::resource('/certificados', \App\Http\Controllers\CertificadoController::class)->middleware('can:certificados');

/* Route::resource('/cron_schedule', \App\Http\Controllers\CronScheduleController::class); */
Route::get('/cron-schedule/edit', [\App\Http\Controllers\CronScheduleController::class, 'edit'])->name('cron_schedule.edit')->middleware('can:configuraciones');
Route::put('/cron-schedule/update', [\App\Http\Controllers\CronScheduleController::class, 'update'])->name('cron_schedule.update');

Route::get('certificadopdf/{id}', [App\Http\Controllers\GenerarCertificadoController::class, 'generarcertificado'])->name('certificadopdf');
Route::get('certificadoword/{id}', [App\Http\Controllers\GenerarCertificadoWordController::class, 'generarCertificadoHTML'])->name('certificadoword');



/* Route::get('/test-websocket', function() {
    event(new App\Events\TestEvent('¡Funciona!'));
    return "Evento enviado";
}); */


Route::get('/ajuste-horas/{id}/obtener', [AjusteHoraController::class, 'obtener']);
Route::post('/ajuste-horas/{id}/guardar-extra', [AjusteHoraController::class, 'guardarExtra']);
Route::post('/ajuste-horas/{id}/guardar-descuento', [AjusteHoraController::class, 'guardarDescuento']);



Route::resource('/convenios', \App\Http\Controllers\ConvenioController::class);
// ==================== RUTAS DE INVENTARIO ====================
Route::middleware(['can:inventarios'])->group(function () {
    
    Route::get('/inventarios/todas/pdf', 
        [InventarioController::class, 'pdfTodas']
    )->name('inventarios.pdf.todas');

    Route::get('inventarios/pdf/todas/{pagina?}', [InventarioController::class, 'pdfTodas']);

    Route::get('/inventarios/cliente/{clienteId}/pdf', 
        [InventarioController::class, 'pdfCliente']
    )->name('inventarios.pdf.cliente');

    Route::get('/inventarios/{id}/pdf', 
        [InventarioController::class, 'pdfInventario']
    )->name('inventarios.pdf');

    Route::resource('/inventarios', InventarioController::class);

});

// ==================== RUTAS DE FACTURACIÓN ====================
Route::prefix('facturacion')->name('facturacion.')->group(function () {

    // ========== MIS RECIBOS (Solo para pasantes - ver sus propios recibos) ==========
    Route::middleware(['can:facturacion.recibos.ver'])->group(function () {
        Route::get('/mis-recibos', [\App\Http\Controllers\FacturacionReciboController::class, 'misRecibos'])->name('mis-recibos');
    });

    // ========== COMPROBANTES (Facturas) ==========
    Route::middleware(['can:facturacion.registros.admin'])->prefix('comprobantes')->name('comprobante.')->group(function () {
        Route::get('/', [\App\Http\Controllers\FacturacionRegistroController::class, 'index'])->name('index');
        Route::get('/{id}/show', [\App\Http\Controllers\FacturacionRegistroController::class, 'show'])->name('show');
        Route::post('/', [\App\Http\Controllers\FacturacionRegistroController::class, 'store'])->name('store');
        Route::put('/{id}', [\App\Http\Controllers\FacturacionRegistroController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\FacturacionRegistroController::class, 'destroy'])->name('destroy');

        // rutas pdf
        Route::get('/todas/pdf', [\App\Http\Controllers\FacturacionRegistroController::class, 'pdfTodas'])->name('pdf.todas');
        Route::get('/enviar/pdf', [\App\Http\Controllers\FacturacionController::class, 'pdfEnviar'])->name('pdf.enviar');
        Route::get('/{id}/pdf', [\App\Http\Controllers\FacturacionRegistroController::class, 'pdfFactura'])->name('pdf');

        Route::post('/{id}/enviar-correo', [\App\Http\Controllers\FacturacionController::class, 'enviarCorreo'])->name('enviar.correo');
        Route::post('/enviar-correo-multiples', [\App\Http\Controllers\FacturacionController::class, 'enviarCorreoMultiples'])->name('enviar-correo-multiples');
    });

    // ========== RECIBOS ==========
    Route::middleware(['can:facturacion.recibos.admin'])->prefix('recibos')->name('recibo.')->group(function () {
        // CRUD completo en FacturacionReciboController
        Route::get('/', [\App\Http\Controllers\FacturacionReciboController::class, 'index'])->name('index');
        Route::get('/{id}/show', [\App\Http\Controllers\FacturacionReciboController::class, 'show'])->name('show');
        Route::post('/', [\App\Http\Controllers\FacturacionReciboController::class, 'store'])->name('store');
        Route::put('/{id}', [\App\Http\Controllers\FacturacionReciboController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\FacturacionReciboController::class, 'destroy'])->name('destroy');

        // IMPORTANTE: Rutas específicas ANTES de rutas con parámetros dinámicos
        Route::get('/todas/pdf', [\App\Http\Controllers\FacturacionReciboController::class, 'pdfTodas'])->name('pdf.todas');
        Route::get('/cliente/{id}/pdf', [\App\Http\Controllers\FacturacionReciboController::class, 'pdfCliente'])->name('pdf.cliente');

        // Rutas de envío de correo
        Route::post('/{id}/enviar-correo', [\App\Http\Controllers\FacturacionReciboController::class, 'enviarCorreo'])->name('enviar.correo');

        // Ruta con {id} al final para evitar conflictos
        Route::get('/{id}/pdf', [\App\Http\Controllers\FacturacionReciboController::class, 'pdfFactura'])->name('pdf');
    });
});

Route::resource('/categorias', \App\Http\Controllers\CategoriaController::class)->middleware('can:categorias');
