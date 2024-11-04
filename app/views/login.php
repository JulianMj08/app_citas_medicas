<?php 
//session_name('prueba');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
    <?php
        use app\controllers\LoginController;

        include 'includes/navbar.php';
    ?>
<div class="container d-flex w-100 mt-4 gap-md-4 gap-lg-1">
    <div class="col-6 d-none d-md-block">
        <img class="object-fit-cover img-login shadow mt-4" src="/assets/img/doctor2.jpg" width="360" height="300" alt="imagen de doctor">
    </div>

    <form id="register-form" action=""  method="post" class="container d-flex flex-column col-10 col-md-6 login-form border rounded shadow p-4 ">
        <div>
            <img src="/assets/icons/icono_logo.png" class="logo" alt="imagen logo">
            <h2 class="fw-bolder">Iniciar Sesión</h2>
        </div>
        <div>
            <h5 class="mt-4">Acceder a TuHospi</h5>
            <p>Accediendo a nuestra app puedes disfrutar de la mejor experiencia</p>
        </div>
        <div class="mb-4">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Correo electrónico">
        </div>
        <?php //echo isset($mensaje) ? "<div style='color:red;'>{$mensaje}</div>" : ""; ?>

        <div class="mb-4">
            <label for="contrasena">Contraseña</label>
            <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
        </div>
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
            <?php endif; ?>
        <div>
             <input type="submit" class="btn btn-primary" name="login-btn" value="Iniciar Sesion">
        </div>

        <div class="m-4">
            <p>¿Nuevo usuario? <a href="register">Registrarse</a></p>
        </div> 
    </form>    

    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <?php unset($_SESSION['message']); // Elimina el mensaje después de mostrarlo ?>
            <?php endif; ?>
</div>    
 <?php
    include 'includes/footer.php';
 ?>   
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>