<?php
session_start();
$nombre = $_SESSION['nombre'];

var_dump($nombre);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>

<?php
include __DIR__ . '/../includes/navbar.php';
?>
 <h2>Perfil de Usuario</h2>
 <hr class="mb-4">   

 <!-- <button class="open-user btn btn-primary mb-2">Ver Usuarios</button> -->

 <div class="container d-flex flex-row m-4 pt-4" id="container-data">

 </div>

 <?php
include __DIR__ . '/../includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/profileClient.js"></script>
</body>
</html>