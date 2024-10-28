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

<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#appointmentCreateModal">Crear cita</button>
<!-- Modal CREATE cita -->
<div class="modal fade" id="appointmentCreateModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="createAppointmentForm">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-2">
            <label for="id-usuario">id usuario<span style="color: red;">*</span></label>
            <input class="form-control" type="text" name="id-usuario" id="id-usuario" placeholder="id-usuario">
        </div>
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

<button class="btn btn-primary mb-2 open-appointments">Ver Citas</button>

<div id="list-notices" class="container">
    <div class="row gx-4 gy-4" id="appointment-row">
        <!-- Aquí se insertarán las tarjetas de forma dinámica -->
    </div>
</div>


<?php
include __DIR__ . '/../includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/appointmentsClient.js"></script>
</body>
</html>