<?php 

session_start(); // Iniciar la sesión

//$email = $_SESSION['email'];
//$nombre = $_SESSION['nombre'];
// $idUser = $_SESSION['idUser'];
// $rol = $_SESSION['rol'];

//$contrasena = $_SESSION['contrasena'];

//var_dump($email);
// var_dump($nombre);
// var_dump($idUser);
// var_dump($rol);


//echo $email;

// var_dump($contrasena);

// echo $contrasena;

// // Verificar si el usuario ha iniciado sesión
// if (!isset($_SESSION['email'])) {
//     header("Location: login");
//     exit();
// }

// $email = $_SESSION['email'];

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Home</title>
</head>
<body>

    <style>

html {
    background-color: blue;
    max-width: 992px;
    margin: 0 auto;
}
body {
    
    background-color: aqua;
}

.image-container {
    position: relative;
    height: 100%;
}
.image-container img {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    object-fit: cover;
    mask-image: linear-gradient(white 80%, transparent);
}

.container-dos img {
    width: 100%;
    object-fit: cover;
}

.border-radius-20 {
    border-radius: 20px !important;
}
    </style>




    <?php
//  session_start();
// //  Verifica si el usuario está autenticado
//   if (isset($_SESSION['nombre'])) {
//       echo "Bienvenido, " . htmlspecialchars($_SESSION['nombre']) . "!";   //Mostramos el nombre
//   } else {
//       echo "No has iniciado sesión.";
//   }
 //session_destroy();

 //session_start();
 // Verificar si el nombre está en la sesión
// if (isset($_SESSION['nombre'])) {
//     $nombre = $_SESSION['nombre'];
// } else {
//     // Si no hay nombre, redirigir al index
//     //header("Location: login");
//     echo 'nooo';
//     //exit();
// }
?>
<?php
include 'includes/navbar.php';
?>
<main class="container bg-light">

<!-- HEADER -->
<header class="container bg-white">
    <div class="row" >
        <div class="col-md-8 d-flex flex-column p-5">
            <div>
                <h2 class="fs-1 fw-bold">Bienvenido a tu sitio donde puedes gestionar todas tus citas</h2>
            </div>
            <div>
                <p class="fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta sit repellat nemo eos, aliquam provident ab unde? Nisi, dolorum repellendus magni omnis deserunt magnam sed tempora minima debitis dolores aperiam!</p>
            </div>
            <div class="mt-3">
                <button  type="button" class="btn btn-primary rounded-pill"> Agendar</button>
            </div>
        </div>

        <div class="col-md-4 image-container">
            <img src="/assets/img/doctor-header.png" alt=""  class="img-fluid">
        </div>
    </div>
</header>

<!-- <h1>Hola, <?php //echo htmlspecialchars($nombre); ?>!</h1>
    
    <p>Dirección: <?php //echo htmlspecialchars($direccion); ?></p> -->
    
    <p>Correo electrónico: <?php //echo htmlspecialchars($email); ?></p>
    <p>Bienvenido a nuestra página.</p>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>

<div class="m-5">
    <h3 class="fw-bold text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, eosilfhsukfh.</h3>
    <p class="text-center">Lorem ipsum dolor sit amet laudantium reprehenderit minima! Quidem soluta ipsum laudantium minus quasi!</p>
</div>
<button class="abrir-News">Abrir noticias</button>

<div id="lista-noticias">

</div>
<!-- <button class="eliminar">eliminar</button> -->

<!-- CARDS -->
<section class="container">
    <div class="row d-flex justify-content-evenly m-4">

            <div class="card" style="width: 18rem;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-6 container-dos m-5 rounded">
            <img class="rounded" src="/assets/img/tres_doctores.jpg" alt="">
        </div>
        
        <div class="card col-md-6" style="width: 18rem;">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
            </ul>
            </div>
    </div>
</section>

<div class="m-5">
    <h3 class="fw-bold text-center">meet Our specialist Doctors.</h3>
    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa natus nostrum laudantium reprehenderit minima! Quidem soluta ipsum laudantium minus quasi!</p>
</div>

<!-- DOCTORES -->
<section class="d-flex justify-content-evenly">
    
<div class="card" style="width: 18rem;">
  <img src="/assets/img/Doctor_1.jpg" class="card-img-top p-3 border-radius-20" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <img src="/assets/img/Doctora.jpg" class="card-img-top p-3 border-radius-20" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <img src="/assets/img/Doctor_2.jpg" class="card-img-top p-3 border-radius-20" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
</section>

<div class="m-5">
    <h3 class="fw-bold text-center">Latest Blog and Events</h3>
    <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa natus nostrum laudantium reprehenderit minima! Quidem soluta ipsum laudantium minus quasi!</p>
</div>

<!-- BLOGS -->
<section class="d-flex justify-content-evenly mb-5">
    
<div class="card" style="width: 18rem;">
  <img src="/assets/img/Doctor_1.jpg" class="card-img-top p-3 border-radius-20" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <img src="/assets/img/Doctora.jpg" class="card-img-top p-3 border-radius-20" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <img src="/assets/img/Doctor_2.jpg" class="card-img-top p-3 border-radius-20" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
</section>

<!-- NEWSLETTER -->
<section class="pt-5">
<div class="card text-center w-75 m-auto bg-primary">
  <div class="">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class=" text-body-secondary">
    2 days ago
  </div>
</div>
</section>
</main>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/home.js"></script>
</body>
</html>