<?php
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;

// Obtener la URL de la página actual
$current_page = basename($_SERVER['REQUEST_URI']);

if ($rol == 'admin') {
?> 
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <style>
        .logo {
            width: 2rem;
            height: 2rem;
        }
        .nav-link.active {
            font-weight: bold;
            color: #0056b3 !important; /* Color del texto del enlace activo */
        }
        .nav-link:hover {
            color: #0056b3 !important; /* Color del texto al pasar el cursor */
            background-color: #e2e6ea; /* Fondo al pasar el cursor */
            border-radius: 5px;
        }
        .cerrar {
            margin-top: 14px;
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
                <div class="navbar-nav d-flex align-items-center">
                    <a class="nav-link <?= $current_page == 'home' ? 'active' : '' ?>" href="home">Inicio</a>
                    <a class="nav-link <?= $current_page == 'notices' ? 'active' : '' ?>" href="notices">Noticias</a>
                    <a class="nav-link <?= $current_page == 'usersAdmin' ? 'active' : '' ?>" href="usersAdmin">Usuarios-admin</a>
                    <a class="nav-link <?= $current_page == 'appointmentsAdmin' ? 'active' : '' ?>" href="appointmentsAdmin">Citaciones-admin</a>
                    <a class="nav-link <?= $current_page == 'noticesAdmin' ? 'active' : '' ?>" href="noticesAdmin">Noticias-admin</a>
                    <a class="nav-link <?= $current_page == 'profileClient' ? 'active' : '' ?>" href="profileClient">Perfil-admin</a>
                    <form action="logout" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-link nav-link cerrar" style="cursor: pointer;">Cerrar sesión</button>
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
        .nav-link.active {
            font-weight: bold;
            color: #0056b3 !important; /* Color del enlace activo */
        }
        .nav-link:hover {
            color: #0056b3 !important;
            background-color: #e2e6ea;
            border-radius: 5px;
        }
        .cerrar {
            margin-top: 14px;
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
                <div class="navbar-nav d-flex align-items-center">
                    <a class="nav-link <?= $current_page == 'home' ? 'active' : '' ?>" href="home">Inicio</a>
                    <a class="nav-link <?= $current_page == 'notices' ? 'active' : '' ?>" href="notices">Noticias</a>
                    <a class="nav-link <?= $current_page == 'appointmentsClient' ? 'active' : '' ?>" href="appointmentsClient">Citaciones</a>
                    <a class="nav-link <?= $current_page == 'profileClient' ? 'active' : '' ?>" href="profileClient">Perfil</a>
                    <form action="logout" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-link nav-link cerrar" style="cursor: pointer;">Cerrar sesión</button>
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
        .nav-link.active {
            font-weight: bold;
            color: #0056b3 !important; /* Color del enlace activo */
        }
        .nav-link:hover {
            color: #0056b3 !important;
            background-color: #e2e6ea;
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
                    <a class="nav-link <?= $current_page == 'home' ? 'active' : '' ?>" href="home">Inicio</a>
                    <a class="nav-link <?= $current_page == 'notices' ? 'active' : '' ?>" href="notices">Noticias</a>
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
