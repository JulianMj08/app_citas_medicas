<?php 
session_start();  

// Mostrar mensaje si existe
if (isset($_SESSION['message'])) {
  echo "<script>alert('" . htmlspecialchars($_SESSION['message']) . "');</script>";
  unset($_SESSION['message']); // Eliminar el mensaje para que no se muestre de nuevo
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/home.css">
    <title>Home</title>
</head>
<body>
    
<?php
include 'includes/navbar.php';
?>

<main class="container bg-light">

<!-- HEADER -->
<header class="container bg-white">
    <div class="row" >
        <div class="col-md-8 col-sm-12 d-flex flex-column p-5">
            <div>
                <h2 class="fs-1 fw-bold">Bienvenido a tu sitio donde puedes gestionar todas tus citas</h2>
            </div>
            <div>
                <p class="fs-6">
                Gestiona fácilmente todas tus citas, accede a tu historial médico y mantente al día
                con las noticias y actualizaciones de nuestra comunidad. Aquí podrás programar,
                modificar y cancelar citas de manera rápida y segura, con la comodidad de acceder
                a toda la información que necesitas desde cualquier lugar. ¡Estamos aquí para cuidar
                 de tu salud y facilitar tu experiencia médica!
                </p>
            </div>
            <div class="mt-3">
            <a href="appointmentsClient" class="btn btn-primary">Agendar</a>
            </div>
        </div>

        <div class="col-md-4 d-none d-md-block image-container">
            <img src="/assets/img/doctor-header.png" alt="imagen doctor"  class="img-fluid">
        </div>
    </div>
</header>

<div class="m-5">
    <h3 class="fw-bold text-center">Todo lo que necesitas para tu atención médica fácil</h3>
    <p class="text-center">Gestiona tus citas, accede a recordatorios y obtén recomendaciones de salud en un solo lugar.</p>
</div>

<div id="lista-noticias">

</div>

<!-- CARDS -->
<section class="container">
    <div class="row d-flex justify-content-evenly gap-sm-4 m-4">
            <div class="card shadow margin" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Agenda y gestiona tus citas</h5>
                    <p class="card-text">
                    Organiza tus citas médicas de forma rápida y sencilla. Desde esta plataforma, puedes agendar,
                    modificar o cancelar tus citas según tu disponibilidad. Recibe notificaciones y recordatorios
                    para que nunca pierdas una consulta importante.
                    </p>
                </div>
            </div>

            <div class="card shadow margin" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Noticias y consejos de salud</h5>
                    <p class="card-text">
                    Mantente informado con las últimas noticias de nuestra comunidad y obtén
                    consejos de salud personalizados. Explora actualizaciones sobre eventos, actividades, y 
                    temas de interés para que puedas cuidar de ti y de tu familia de manera preventiva y proactiva.
                    </p>
                </div>
            </div>

            <div class="card shadow margin" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Recibe recordatorios de medicación</h5>
                    <p class="card-text">
                    Lleva el control de tu tratamiento con recordatorios automáticos. Configura alertas para tus
                    medicamentos y nunca olvides una dosis importante. Con esta función, puedes gestionar tus
                    tratamientos de forma práctica y mantener el seguimiento necesario para cuidar de tu salud día a día.
                    </p>
                </div>
            </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row width-100 w-sm-100 d-sm-flex justify-content-sm-center">
        <div class="col-md-6 container-dos m-5 rounded">
            <img class="rounded" src="/assets/img/tres_doctores.jpg" alt="imagen tres doctores">
        </div>
        
        <div class="card col-md-6" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Servicios Médicos Destacados</h5>
                <p class="card-text">
                    Contamos con una variedad de servicios para atender
                    tus necesidades de salud de manera completa y personalizada. Desde 
                    consultas generales hasta especialidades médicas, estamos aquí para
                    apoyarte en cada paso
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Consulta médica general</strong></li>
                <li class="list-group-item"><strong>Especialidades en cardiología y pediatría</strong></li>
                <li class="list-group-item"><strong>Servicios de diagnóstico y laboratorio</strong></li>
            </ul>
            </div>
    </div>
</section>
<hr class="mb-4">

<div class="m-5">
    <h3 class="fw-bold text-center">Conoce a Nuestros Especialistas</h3>
    <p class="text-center">
    Contamos con un equipo de médicos especializados en diversas áreas de la salud,
    comprometidos con brindarte una atención de calidad. Cada uno de nuestros especialistas
    está altamente capacitado para atender tus necesidades con profesionalismo y dedicación.
    </p>
</div>

<!-- DOCTORES -->
<section class="d-flex justify-content-evenly doctors-movil w-sm-100 d-sm-flex flex-wrap gap-sm-4">
    
<div class="card shadow" style="width: 18rem;">
  <img src="/assets/img/Doctor_1.jpg" class="card-img-top p-3 border-radius-20" alt="imagen doctor">
  <div class="card-body">
    <h5 class="card-title">Dr. Carlos Méndez</h5>
    <p class="card-text">
        Especialista en cardiología con más de 15 años de experiencia.
        Comprometido con la salud cardiovascular, brinda una atención dedicada y
        detallada a cada paciente.
    </p>
  </div>
</div>

<div class="card shadow" style="width: 18rem;">
  <img src="/assets/img/Doctora.jpg" class="card-img-top p-3 border-radius-20" alt="imagen doctora">
  <div class="card-body">
    <h5 class="card-title">Dra. Ana Salazar</h5>
    <p class="card-text">
        Experta en medicina familiar, enfocada en el cuidado integral de la familia.
        Apasionada por la prevención y educación en salud para mejorar la calidad
         de vida..
    </p>
  </div>
</div>

<div class="card shadow" style="width: 18rem;">
  <img src="/assets/img/Doctor_2.jpg" class="card-img-top p-3 border-radius-20" alt="imagen doctor">
  <div class="card-body">
    <h5 class="card-title">Dr. Julio Ramos</h5>
    <p class="card-text">
        Cirujano ortopédico con amplia trayectoria en tratamientos de trauma y
        recuperación. Su objetivo es ayudar a cada paciente a mejorar su movilidad
        y bienestar.
    </p>
  </div>
</div>
</section>


<div class="m-5">
    <h3 class="fw-bold text-center">Últimos Blogs y Eventos</h3>
    <p class="text-center">
    Mantente informado con nuestras últimas publicaciones y eventos destacados.
    Aquí encontrarás consejos de salud, novedades médicas, y actividades especiales
    para toda la comunidad. ¡Explora y participa en nuestro compromiso por una vida
     saludable y activa!
    </p>
</div>

<!-- BLOGS -->
<section class="d-flex justify-content-evenly mb-5 blogs-events w-sm-100 d-sm-flex flex-wrap gap-sm-4">
    
<div class="card" style="width: 18rem;">
  <img src="/assets/img/urgencias.jpg" class="card-img-top p-3 border-radius-20" alt="imagen urgencias">
  <div class="card-body">
    <h5 class="card-title">Inauguración nueva sala de urgencias</h5>
    <p class="card-text">La sala de urgencias ha sido renovada y modernizada para ofrecer la mejor atención de primera calidad...</p>
    <a href="notices" class="btn btn-primary">Leer más</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <img src="/assets/img/maraton.jpg" class="card-img-top p-3 border-radius-20" alt="imagen maraton">
  <div class="card-body">
    <h5 class="card-title">Maratón anual para recaudar fondos</h5>
    <p class="card-text">El hospital organizará un maratón con el fin de recaudar fondos para la compra de nuevos equipos médicos...</p>
    <a href="notices" class="btn btn-primary">Leer más</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
  <img src="/assets/img/vacunacion.jpg" class="card-img-top p-3 border-radius-20" alt="imagen vacunación">
  <div class="card-body">
    <h5 class="card-title">Jornada de vacunación en el barrio</h5>
    <p class="card-text">El hospital ha organizado una jornada de vacunación gratuita en colaboración con la municipalidad local...</p>
    <a href="notices" class="btn btn-primary">Leer más</a>
  </div>
</div>
</section>
<hr class="mb-4">

<!-- NEWSLETTER -->
<section class="pt-4 pb-4">
<div class="card text-center w-75 m-auto bg-primary">
  <div class="p-2 text-light">
    Novedad
  </div>
  <div class="card-body">
    <h5 class="card-title text-light">Recibe nuestras últimas actualizaciones</h5>
    <p class="card-text">Mantente informado con lo último en salud, eventos y consejos prácticos. Únete a nuestro boletín y no te pierdas ninguna novedad importante..</p>
    <a href="#" class="btn btn-primary border">Suscríbete aquí</a>
  </div>
</div>
</section>
</main>
<?php 
  include 'includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/home.js"></script>
</body>
</html>