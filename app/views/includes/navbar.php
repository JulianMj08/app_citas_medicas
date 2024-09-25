<!-- <h2>"Hola Mundo !"</h2> -->

<link rel="stylesheet" href="/css/bootstrap.min.css">

<style>
  .logo {
    width: 30px;
    height: 30px;
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
        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        <a class="nav-link" href="#">Noticias</a>
        <!-- <a class="nav-link" href="#">Pricing</a> -->
        
        <!-- <a class="nav-link disabled" aria-disabled="true">Disabled</a> -->
      </div>
      <div>
      <button  id="button-register" class="ms-auto btn btn-primary rounded-pill">Registrarse</button>
      <button  id="button-login" class="ms-auto btn btn-primary rounded-pill">Iniciar sesión</button>
      </div>
      
    </div>
  </div>
</nav>

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