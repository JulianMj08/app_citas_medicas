<link rel="stylesheet" href="/css/bootstrap.min.css">
<script src="/js/bootstrap.bundle.min.js"></script>

<?php
require_once '../app/router/Route.php';
require_once '../app/router/routes.php';
require_once '../app/models/NewsAdminModel.php';
//require_once '../app/controllers/NewsAdminController.php';


 //require_once '../app/models/Conexion.php';
 //NewsAdminModel::seeAllNews();

 Route::dispatch();

 //NewsAdminModel::createNotice('deporte extremo', 'ruta/a/tuu_imagcen.jpg', 'esta es una noticia sobre deporte', '2023-11-10', 6 );
