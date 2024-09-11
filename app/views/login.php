<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
include 'includes/navbar.php';


// // Verificar si existen los datos en la sesión
// if (isset($_SESSION['nombre']) && isset($_SESSION['apellidos'])) {
//     echo "Nombre: " . htmlspecialchars($_SESSION['nombre']) . "<br>";
//     echo "Apellidos: " . htmlspecialchars($_SESSION['apellidos']) . "<br>";
//     //echo "Email: " . htmlspecialchars($_SESSION['email']) . "<br>";
//     // ... muestra otros datos si es necesario
// } else {
//     echo "No hay datos del formulario";
// }

// //session_destroy();
    ?>
<div class="container d-flex w-50 mt-4">
    <div>
        <img src="/assets/img/doctor-with-his-arms-crossed-white-background.jpg" width="300" height="300" alt="hjgjg">
    </div>

    <form id="register-form" action=""  method="post" class="container d-flex flex-column w-50 border rounded shadow p-4">
        <div>
            <img src="/assets/icons/icono_logo.png" class="logo" alt="">
        </div>
        <div>
            <h5 class="mt-4">Acceder a TuHospi</h5>
            <p>Accediendo a nuestra app puedes disfrutar de la mejor experiencia</p>
        </div>
        <div class="mb-4">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Correo electrónico">
        </div>
        <div class="mb-4">
            <label for="contrasena">Contraseña</label>
            <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
        </div>
        <div>
             <input type="submit" class="btn btn-primary" name="register-btn" value="Iniciar Sesion">
        </div>
    </form>    


</body>
</html>