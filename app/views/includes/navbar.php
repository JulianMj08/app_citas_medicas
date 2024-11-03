<?php
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;

if ($rol == 'admin') {
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
            <img src="/assets/icons/icono_logo.png" class="logo" alt="imagen logo">
            <a class="navbar-brand fw-bold" href="home">TuHospi</a>
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation" id="navbar-toggler-admin">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup-admin">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="home">Inicio</a>
                    <a class="nav-link" href="notices">Noticias</a>
                    <a class="nav-link" href="usersAdmin">Usuarios-admin</a>
                    <a class="nav-link" href="appointmentsAdmin">Citaciones-admin</a>
                    <a class="nav-link" href="noticesAdmin">Noticias-admin</a>
                    <a class="nav-link" href="profileClient">Perfil-admin</a>
                    <form action="logout" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-link nav-link" style="cursor: pointer;">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

<?php
} elseif ($rol == 'user') {
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
            <img src="/assets/icons/icono_logo.png" class="logo" alt="imagen logo">
            <a class="navbar-brand fw-bold" href="home">TuHospi</a>
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation" id="navbar-toggler-user">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup-user">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="home">Inicio</a>
                    <a class="nav-link" href="notices">Noticias</a>
                    <a class="nav-link" href="appointmentsClient">Citaciones</a>
                    <a class="nav-link" href="profileClient">Perfil</a>
                    <form action="logout" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-link nav-link" style="cursor: pointer;">Cerrar sesión</button>
                    </form>
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

        .nav-link:hover {
            color: #0056b3 !important; /* Color del texto en hover */
            background-color: #e2e6ea; /* Color de fondo en hover */
            border-radius: 5px;
        }
    </style>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
        <div class="container-fluid">
            <img src="/assets/icons/icono_logo.png" class="logo" alt="imagen logo">
            <a class="navbar-brand fw-bold" href="home">TuHospi</a>
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation" id="navbar-toggler-visitor">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup-visitor">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="home">Inicio</a>
                    <a class="nav-link" href="notices">Noticias</a>
                </div>
                <div>
                    <button id="button-register" class="ms-auto btn btn-primary">Registrarse</button>
                    <button id="button-login" class="ms-auto btn btn-primary">Iniciar sesión</button>
                </div>
            </div>
        </div>
    </nav>

<?php
}
?>


<script src="/js/navbar.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
