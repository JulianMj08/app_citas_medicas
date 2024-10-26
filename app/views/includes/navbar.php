<?php

// $filePath = __DIR__ . '/../../../auth/Logout.php';

// if (!file_exists($filePath)) {
//     die("El archivo no existe: " . $filePath);
// }

// require_once $filePath;

include_once __DIR__ . '/../../auth/Authentication.php';
// require_once __DIR__ . '/../../../auth/Logout.php';

// $filePath = __DIR__ . '/../../../auth/Logout.php';

// if (!file_exists($filePath)) {
//     die("El archivo no existe: " . $filePath);
// }

// require_once $filePath;

//Logout::logout();
//session_start();
// if (session_status() === PHP_SESSION_NONE) {
//   session_start();
// }


  //$rol = $_SESSION['rol'];
  $rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;

  if($rol == 'admin') {
    ?> 
    <link rel="stylesheet" href="/css/bootstrap.min.css">

<style>
  .logo {
    width: 2rem;
    height: 2rem;
  }
</style>

 <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
  <div class="container-fluid">
    <img src="/assets/icons/icono_logo.png" class="logo" alt="">
    <a class="navbar-brand fw-bold" href="#">TuHospi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="home">Inicio</a>
        <a class="nav-link" href="notices">Noticias</a>
        <a class="nav-link" href="usersAdmin">Usuarios-admin</a>
        <a class="nav-link" href="appointmentsAdmin">Citaciones-admin</a>
        <a class="nav-link" href="noticesAdmin">Noticias-admin</a>
        <a class="nav-link" href="profileClient">Perfil-admin</a>
        <!-- <a class="nav-link" href="logout.php">Cerrar sesión</a> -->
        <form action="logout" method="POST" style="display:inline;">
          <button type="submit" class="btn btn-link nav-link" style="cursor: pointer;">Cerrar sesión</button>
      </form>
      </div>
      <div>      
    </div>
  </div>
</nav>

<?php
  }
  elseif($rol == 'user') {
    ?>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

<style>
  .logo {
    width: 2rem;
    height: 2rem;
  }
</style>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
  <div class="container-fluid">
    <img src="/assets/icons/icono_logo.png" class="logo" alt="">
    <a class="navbar-brand fw-bold" href="#">TuHospi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="home">Inicio</a>
        <a class="nav-link" href="notices">Noticias</a>
        <a class="nav-link" href="appointmentsClient">Citaciones</a>
        <a class="nav-link" href="profileClient">Perfil</a>
        <!-- <a class="nav-link" href="logout.php">Cerrar sesión</a> -->
        <form action="logout" method="POST" style="display:inline;">
          <button type="submit" class="btn btn-link nav-link" style="cursor: pointer;">Cerrar sesión</button>
      </form>
      </div>
      <div>
      </div>
      
    </div>
  </div>
</nav>
    <?php
  } else {
    ?>

<link rel="stylesheet" href="/css/bootstrap.min.css">

<style>
  .logo {
    width: 2rem;
    height: 2rem;
  }
</style>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
  <div class="container-fluid">
    <img src="/assets/icons/icono_logo.png" class="logo" alt="">
    <a class="navbar-brand fw-bold" href="#">TuHospi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="home">Inicio</a>
        <a class="nav-link" href="notices">Noticias</a>
      </div>
      <div>
      <button  id="button-register" class="ms-auto btn btn-primary rounded-pill">Registrarse</button>
      <button  id="button-login" class="ms-auto btn btn-primary rounded-pill">Iniciar sesión</button>
      </div>
      
    </div>
  </div>
</nav>

  <?php
  }

?>





<!-- navBar para Admin -->

<!-- La barra de navegación de un administrador deberá mostrar las siguientes secciones:
◼ index
◼ noticias
◼ usuarios-administracion
◼ citaciones-administracion
◼ noticias-administracion
◼ perfil
◼ cerrar sesión (Si el administrador hace clic sobre esta opción, se le
permitirá salir de la cuenta y se convertirá en un visitante, por lo que en
la barra de navegación ya no se deberán ver (ni poder acceder) a las
secciones exclusivas de los administradores). -->



<!-- navBar para user -->

<!-- La barra de navegación de un usuario deberá mostrar las siguientes secciones:
◼ index
◼ noticias
◼ citaciones
◼ perfil
◼ cerrar sesión (Si el usuario hace clic sobre esta opción, se le permitirá
salir de la cuenta y se convertirá en un visitante, por lo que ya no se verán las páginas perfil y citaciones en la barra de navegación, exclusivas
de los usuarios) -->


<!-- navBar para visitantes -->

<!-- El visitante deberá ver en todas las páginas del sitio web (index, noticias,
registro e inicio de sesión) una barra de navegación que le permitirá navegar
entre dichas páginas y que resalte en qué página se encuentra en ese momento
dentro del sitio web. -->






<script>
  const btnLogin = document.getElementById('button-login');
  const btnRegister = document.getElementById('button-register');

const goLogin = ()=> window.location.href = '/login';
const goRegister = ()=> window.location.href = '/register';

btnLogin.addEventListener('click', goLogin);
btnRegister.addEventListener('click', goRegister);
</script>

<script src="/js/bootstrap.bundle.min.js"></script>
    
</script>