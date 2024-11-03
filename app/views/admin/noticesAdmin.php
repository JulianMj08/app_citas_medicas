<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <title>Noticias Administración</title>
</head>
<body>
    
<?php
include __DIR__ . '/../includes/navbar.php';
?>
<h2>Gestión de noticias</h2>
<hr class="mb-2">

<button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#noticeCreateModal">Crear Noticia</button>

<div id="list-notices" class="container">
    <div class="row gx-4 gy-4" id="notices-row">
        <!-- Aquí se insertarán las tarjetas de forma dinámica -->
    </div>
</div>

<!-- Modal UPDATE -->
<div class="modal fade" id="noticeUpdateModal" class="container border" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="text" class="form-control" id="modalTitle" placeholder="Titulo de la noticia">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea name="noticeTexUpdate" class="form-control" id="modalText" rows="10" placeholder="Descripción de la noticia"></textarea>
        <input type="file" class="form-control mt-2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal CREATE -->
<div class="modal fade" id="noticeCreateModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="createNoticeForm" enctype="multipart/form-data">
      <div class="modal-header">
        <input type="text" class="form-control" id="titleNotice" placeholder="Titulo de la noticia">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea name="noticeTextCreate" class="form-control " id="textNotice" rows="10" placeholder="Descripción de la noticia"></textarea>
        <input type="file" id="imageNotice" class="form-control mt-2" name="image">
        <input class="form-control mt-2" type="date" id="fechaNotice">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="saveNotice">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/noticesAdmin.js"></script>

</body>
</html>
