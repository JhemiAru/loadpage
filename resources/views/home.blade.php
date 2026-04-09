<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página Principal</title>

    <!-- Estilos (puedes usar Tailwind si quieres) -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: white;
        }
        header {
            background: #1e293b;
            padding: 15px;
            text-align: center;
        }
        nav a {
            color: #38bdf8;
            margin: 0 10px;
            text-decoration: none;
        }
        .hero {
            padding: 60px;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
        }
        .btn {
            background: #38bdf8;
            padding: 10px 20px;
            border-radius: 8px;
            color: black;
            text-decoration: none;
        }
        footer {
            background: #1e293b;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <h2>Mi Proyecto Laravel</h2>
    <nav>
        <a href="/">Inicio</a>
        <a href="#">Servicios</a>
        <a href="#">Contacto</a>
    </nav>
</header>

<section class="hero">
    <h1>Bienvenido 🚀</h1>
    <p>Esta es una página principal sin conexión a base de datos</p>
    <br>
    <a href="#" class="btn">Comenzar</a>
</section>

<footer>
    <p>© {{ date('Y') }} - Todos los derechos reservados</p>
</footer>

</body>
</html>
