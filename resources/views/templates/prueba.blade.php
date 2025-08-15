<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Bienvenido a Nuestra Aplicación</h1>
    </header>
    <main>
        <p>Gracias por visitar nuestra página. ¡Esperamos que disfrutes la experiencia!</p>
        <a href="{{ route('login') }}">Iniciar Sesión</a>
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Mi Aplicación Laravel</p>
    </footer>
</body>
</html>