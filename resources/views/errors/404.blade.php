<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada | FaceBol</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #0d1f45 0%, #1a3a6b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .error-container {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
        }
        .error-code {
            font-family: 'Poppins', sans-serif;
            font-size: 8rem;
            font-weight: 800;
            color: #f5a623;
            text-shadow: 4px 4px 0 rgba(0,0,0,0.2);
            line-height: 1;
        }
        .error-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin: 1rem 0;
        }
        .error-message {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #f5a623;
            color: #1a3a6b;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn-home:hover {
            background: #e69500;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: #1a3a6b;
        }
        .brand {
            margin-top: 2rem;
            font-size: 0.85rem;
            opacity: 0.7;
        }
        .brand a {
            color: #f5a623;
            text-decoration: none;
        }
        @media (max-width: 480px) {
            .error-code { font-size: 5rem; }
            .error-title { font-size: 1.5rem; }
            .error-message { font-size: 0.9rem; }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">¡Ups! Página no encontrada</h1>
        <p class="error-message">
            La página que estás buscando no existe o fue movida a otra dirección.
        </p>
        <a href="{{ url('/') }}" class="btn-home">
            <i class="fas fa-home"></i> Volver al inicio
        </a>
        <div class="brand">
            FaceBol SRL | <a href="{{ url('/') }}">facebolsrl.net</a>
        </div>
    </div>
</body>
</html>