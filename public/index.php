<h1>Index</h1>

<?php

require_once '../app/router/Route.php';
require_once '../app/router/routes.php';
require_once '../app/models/Conexion.php';
Route::dispatch();
Conexion::connect();


?>