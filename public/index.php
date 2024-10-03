<link rel="stylesheet" href="/css/bootstrap.min.css">
<script src="/js/bootstrap.bundle.min.js"></script>

<?php
require_once '../app/router/Route.php';
require_once '../app/router/routes.php';
require_once '../app/models/NoticeAdminModel.php';
//require_once '../app/controllers/NewsAdminController.php';

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type");

 //require_once '../app/models/Conexion.php';
 Route::dispatch();

