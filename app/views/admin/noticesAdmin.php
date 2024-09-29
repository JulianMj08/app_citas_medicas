<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <title>Document</title>
</head>
<body>
    
<?php
include __DIR__ . '/../includes/navbar.php';
//require_once __DIR__ . '/../../controllers/NewsAdminController.php';
?>
<h1>Gestión de noticias</h1>

<button class="btn btn-primary rounded-pill open-notices">Ver todas la noticias</button>

<div class="container border p-2" id="list-notices">

</div>

<!-- Botón que dispara el modal -->
<!-- <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#noticeModal">
  Abrir Modal
</button> -->

<!-- Modal UPDATE -->
<div class="modal fade" id="noticeUpdateModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="text" class="form-control" id="modalTitle" placeholder="Titulo de la noticia">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea name="notice-texto" class="form-control " id="modalText" rows="10" placeholder="Descripción de la noticia"></textarea>
        <input type="file" class="form-control mt-2">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>


<button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#noticeCreateModal">Crear Noticia</button>
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
        <textarea name="notice-texto" class="form-control " id="textNotice" rows="10" placeholder="Descripción de la noticia"></textarea>
        <input type="file" id="imageNotice" class="form-control mt-2" name="image">
        
        <input type="text" id="fechaNotice">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="saveNotice">Guardar</button>
        <!-- <input type="submit" class="btn btn-primary" id="saveNotice" value="Guardar" > -->
      </div>
      </form>
    </div>
  </div>
</div>


<section class="d-flex">
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">noticia uno</li>
    <li class="list-group-item">noticia dos</li>
    <li class="list-group-item">noticia tres</li>
    <li class="list-group-item">noticia cuatro</li>
  </ul>
</div>
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">noticia cinco</li>
    <li class="list-group-item">noticia seis</li>
    <li class="list-group-item">noticia siete</li>
    <li class="list-group-item">noticia ocho</li>
  </ul>
</div>
</section>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/noticesAdmin.js"></script>

</body>
</html>
