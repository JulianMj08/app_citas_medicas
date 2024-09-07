<link rel="stylesheet" href="/css/bootstrap.min.css">
<script src="/js/bootstrap.bundle.min.js"></script>

<?php

require_once '../app/router/Route.php';
require_once '../app/router/routes.php';
// require_once '../app/models/Conexion.php';
// require_once '../app/models/RegisterModel.php';
Route::dispatch();
// RegisterModel::muestra();

//Conexion::connect();



?>