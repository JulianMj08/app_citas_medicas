<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    
    <title>Register</title>
</head>
<body>
    <?php
    //include_once './../app/controllers/RegisterController.php';
    include 'includes/navbar.php';
    ?>
    <div class="container d-flex">

    <style>
        .img-register {
            mask-image: linear-gradient(white 80%, transparent);
        }
    </style>
    <!-- Formulario -->
    <form id="register-form" action="register"  method="post" class="container d-flex">
        <div class="col-6 p-4">
            <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
            <?php endif; ?>
        <div class="mb-2">
            <label for="nombre">Nombre<span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre">
        </div>
        <div class="mb-2">
            <label for="apellidos">Apellidos<span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos">
        </div>
        <div class="mb-2">
            <label for="usuario">Usuario<span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Nombre de usuario">
        </div>
        <div class="mb-2">
            <label for="email">Email<span style="color: red;">*</span></label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Correo electrónico">
        </div>
        <div class="mb-2">
            <label for="contrasena">Contraseña<span style="color: red;">*</span></label>
            <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
        </div>
        <!-- Segunda parte del formulario -->
        </div>
        <div class="col-6 p-4">
        <div class="mb-2">
            <label for="direccion">Dirección</label>
            <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Dirección de residencia">
        </div>
        <div class="mb-2">
            <label for="telefono">Telefono<span style="color: red;">*</span></label>
            <input class="form-control" type="number" name="telefono" id="telefono" placeholder="Número de telefono">
        </div>
        <div class="mb-2">
            <label for="fecha-nacimiento">Fecha-nacimiento<span style="color: red;">*</span></label>
            <input class="form-control" type="date" name="fecha-nacimiento" id="fecha-nacimiento" placeholder="Fecha de nacimiento">
        </div>
        <span>Sexo</span>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="hombre" value="hombre">
            <label class="form-check-label" for="hombre">Hombre</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sexo" id="mujer" value="mujer" checked>
            <label class="form-check-label" for="mujer">Mujer</label>
        </div>
        <div>
             <input type="submit" class="btn btn-primary" name="register-btn" value="Registrarse">
        </div>
        </div>  
    </form>

    <div>
        <img class="object-fit-cover img-register" src="/assets/img/doctora2.jpg" width="300" height="300" alt="hjgjg">
    </div>

    </div>
    <?php
    include 'includes/footer.php';
    ?>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>