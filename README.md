Alterar la tabla de categotias para poner iconos con el siguiente SLQ:
ALTER TABLE categorias 
ADD COLUMN icono VARCHAR(100) NULL AFTER imagen;

Luego agregar lso iconos con: 
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