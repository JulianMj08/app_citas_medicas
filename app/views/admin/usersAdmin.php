<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <link rel="stylesheet" href="/css/usersAdmin.css">
    <title>Gestion de usuarios</title>
</head>
<body>
<?php

include __DIR__ . '/../includes/navbar.php';

?>
<h2>Gestion de Usuarios</h2>
<hr class="mb-2">

<button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#userCreateModal">Crear Usuario</button>

<!-- SHOW Users -->
<div id="container-table" class="container" style="display: none;">
    <div class="row">
        <div class="col">
            <div class="table-responsive-sm"> 
                <table class="table table-striped table-bordered table-hover align-middle">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Nombre de usuario</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Rol de Usuario</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal CREATE cita -->
<div class="modal fade" id="userCreateModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="createUserForm">
      <div class="modal-header">
      <div class="container d-flex">
    
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
        <div class="mb-2">
            <label for="telefono">Rol de Usuario<span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="rol" id="rol" placeholder="user o admin">
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="saveUser">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
include __DIR__ . '/../includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/usersAdmin.js"></script>   
</body>
</html>