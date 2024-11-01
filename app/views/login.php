<?php 
//session_name('prueba');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <title>Login</title>
</head>
<body>
<style>
    .img-login {
        mask-image: linear-gradient(white 80%, transparent);
        
    }
</style>
    <?php
        use app\controllers\LoginController;

        include 'includes/navbar.php';
    ?>
<div class="container d-flex w-50 mt-4 gap-4">
    <div class="col-6">
        <img class="object-fit-cover img-login shadow mt-4" src="/assets/img/doctor2.jpg" width="350" height="300" alt="imagen de doctor">
    </div>

    <form id="register-form" action=""  method="post" class="container d-flex flex-column col-4 w-50 border rounded shadow p-4 m-4">
        <div>
            <img src="/assets/icons/icono_logo.png" class="logo" alt="">
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
    </form>    

</div>    
 <?php
 include 'includes/footer.php';
 ?>   

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>