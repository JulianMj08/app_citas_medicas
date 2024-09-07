<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php

//session_start();  // Inicia la sesión en la página de login

// Verificar si existen los datos en la sesión
if (isset($_SESSION['nombre']) && isset($_SESSION['apellidos'])) {
    echo "Nombre: " . htmlspecialchars($_SESSION['nombre']) . "<br>";
    echo "Apellidos: " . htmlspecialchars($_SESSION['apellidos']) . "<br>";
    echo "Email: " . htmlspecialchars($_SESSION['email']) . "<br>";
    // ... muestra otros datos si es necesario
} else {
    echo "No hay datos del formulario";
}

session_destroy();
    ?>
</body>
</html>