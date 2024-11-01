<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>Citas del Usuario</title>
</head>
<body>
<?php
include __DIR__ . '/../includes/navbar.php';
?>
<h2>Gestiona tus citas</h2>
<hr class="mb-4">

<div class="p-2">
  <p class="fs-5">Organiza y visualiza tus citas médicas en un solo lugar.
      Agenda nuevas consultas y revisa tus próximas visitas para
      gestionar tu tiempo de manera efectiva.
</p>
</div>


<button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#appointmentCreateModal">Agendar cita</button>
<!-- Modal CREATE cita -->
<div class="modal fade" id="appointmentCreateModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="createAppointmentForm">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <!-- <div class="mb-2">
            <label for="id-usuario">id usuario<span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="id-usuario" id="id-usuario" placeholder="id-usuario">
        </div> -->
        <div class="mb-2">
            <label for="motivo-cita">Motivo de la cita<span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="motivo-cita" id="motivo-cita" placeholder="Motivo de la cita">
        </div>
        <div class="mb-2">
            <label for="fecha-cita">Fecha de la cita<span style="color: red;">*</span></label>
            <input class="form-control" type="date" name="fecha-cita" id="fecha-cita" placeholder="Fecha de la cita">
        </div>   
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="saveAppointment">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<button class="btn btn-primary m-2 open-appointments">Ver citas</button>

<div id="list-notices" class="container">
    <div class="row gx-4 gy-4" id="appointment-row">
        <!-- Aquí se insertarán las tarjetas de forma dinámica -->
    </div>
</div>

<section class="m-4 pt-4 container d-flex  ">
  <div class="col-6">
  <h4>Prepárate para tu cita</h4>
  <ul>
    <li>Lleva tu identificación y tarjeta de seguro.</li>
    <li>Llega 15 minutos antes de la hora programada.</li>
    <li>Trae una lista de los medicamentos que tomas.</li>
    <li>Anota tus síntomas o preguntas para el doctor.</li>
    <li>Verifica la ubicación de la clínica antes de tu cita.</li>
    <li>Lleva resultados previos de exámenes, si los tienes.</li>
    <li>Usa ropa cómoda para facilitar exámenes médicos.</li>
    <li>Lleva un acompañante si crees que será necesario.</li>
    <li>Confirma tu cita un día antes para evitar inconvenientes.</li>
    <li>Llega con tiempo para el registro y la recepción.</li>
    <li>Lleva Toda la documentacion necesaria.</li>
  </ul>
  </div>
  <div class="col-6">
    <img class="img-calendario rounded shadow" src="/assets/img/calendario.jpg" alt="">
  </div>
  
</section>

<section class="p-4 text-center">
  Recuerda que cada consulta es una oportunidad para cuidar de tu bienestar.
  Aprovecha el tiempo con tu médico para resolver dudas, recibir orientación
  y seguir tu plan de salud. Estamos aquí para apoyarte en cada paso de tu
  camino hacia una vida más saludable y plena.
</section>

<style>

.img-calendario {
  width: 300px;
  height: 320px;
  object-fit: cover;
}
</style>
<?php
include __DIR__ . '/../includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/appointmentsClient.js"></script>
</body>
</html>