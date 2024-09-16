<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        use app\controllers\LoginController;

        include 'includes/navbar.php';
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
        <?php //echo isset($mensaje) ? "<div style='color:red;'>{$mensaje}</div>" : ""; ?>

        
        <div class="mb-4">
            <label for="contrasena">Contraseña</label>
            <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
        </div>
            <?php if (isset($error) && $error): ?>
                <div style="color:red;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
        <div>
             <input type="submit" class="btn btn-primary" name="login-btn" value="Iniciar Sesion">
        </div>
    </form>    


</body>
</html>