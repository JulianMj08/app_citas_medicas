<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>

    <?php
 session_start();

 echo '<pre>';
var_dump($_SESSION);
echo '</pre>';


//  Verifica si el usuario está autenticado
//  if (isset($_SESSION['user_id'])) {
//      echo "Bienvenido, " . htmlspecialchars($_SESSION['nombre']) . "!";  // Mostramos el nombre
//  } else {
//      echo "No has iniciado sesión.";
//  }

?>

    <button id="button-login">Ir al login</button>
    <script src="/js/home.js"></script>


</body>
</html>