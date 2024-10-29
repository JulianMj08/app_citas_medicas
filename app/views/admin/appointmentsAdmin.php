<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Administracion</title>
</head>
<body>
    
<?php
include __DIR__ . '/../includes/navbar.php';
?>
<h2>Gestión de Citas</h2>
<hr class="mb-2">

<!-- <button class="open-appointments btn btn-primary mb-2">Ver Citas</button>  -->


<button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#appointmentCreateModal">Crear cita</button>
<!-- Modal CREATE cita -->
<div class="modal fade" id="appointmentCreateModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="createAppointmentForm">
      <div class="modal-header">
      <div class="container d-flex">
            <div id="containerSelectUsers"> 
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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


<!-- SHOW Appointments -->
<div id="container-table" class="class container" style="display: none;">
    <div class="class row">
        <div class="class col">
            <table class="table table-striped table-bordered table-hover table align-middle">
                <thead>
                    <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Numero de telefono</th>
                    <th scope="col">Motivo de la cita</th>
                    <th scope="col">fecha de la cita</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
            
                </tbody>
            </table>
         </div>
    </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/appointmentsAdmin.js"></script>
</body>
</html>

