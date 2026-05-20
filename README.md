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




-- Evento para respaldo de asistencias
SET GLOBAL event_scheduler = ON;

CREATE TABLE IF NOT EXISTS resp LIKE asistencias;

DELIMITER $$
CREATE EVENT IF NOT EXISTS evt_resp_asis
ON SCHEDULE EVERY 1 WEEK
STARTS CURRENT_TIMESTAMP
DO
BEGIN
    IF EXISTS (
        SELECT 1 
        FROM information_schema.tables 
        WHERE table_schema = DATABASE() 
          AND table_name = 'asistencias'
    ) THEN
        TRUNCATE TABLE resp;
        INSERT INTO resp SELECT * FROM asistencias;
        
    END IF;
END$$
DELIMITER ;

-- Opcionalmente se puede reemplazar STARTS CURRENT_TIMESTAMP por el siguioente para tener por un dia y hora concreto STARTS TIMESTAMP(DATE_ADD(CURDATE(), INTERVAL (5 - DAYOFWEEK(CURDATE()) + IF(DAYOFWEEK(CURDATE()) > 6, 7, 0)) DAY), '23:59:00')