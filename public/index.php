<link rel="stylesheet" href="/css/bootstrap.min.css">
<script src="/js/bootstrap.bundle.min.js"></script>

<?php
require_once '../app/router/Route.php';
require_once '../app/router/routes.php';
require_once '../app/models/NoticeAdminModel.php';
require_once '../app/models/AppointmentsAdminModel.php';
require_once '../app/models/UsersAdminModel.php';
require_once '../app/controllers/AppointmentsAdminController.php';
//require_once '../app/controllers/NewsAdminController.php';


 //require_once '../app/models/Conexion.php';
 Route::dispatch();

//  $usuarioEliminado = UsersAdminModel::deleteUserModel(1);

//  var_dump($usuarioEliminado);
//   echo "<div>";
//   print_r($usuarioEliminado);
//  echo "</div>";


// $nuevoUsuario = UsersAdminModel::createUser('hernanhernando', 'gutierrezperea', 'hernansitoguti', 'hernan@gmail.com', '123456789', 'armenia quindio', '602416080', '2022-01-01', 'hombre', 'admin');
 
//   var_dump($nuevoUsuario);
//    echo "<div>";
//    print_r($nuevoUsuario);
//   echo "</div>";

 
 //var_dump(($data));
 //AppointmentsAdminModel::updateAppointmentModel('julianitagomez', 'armeniaquindio', '888888888', 'koooo', '2023-02-03', 7);

 /*
 $appointments = AppointmentsAdminModel::seeAllAppointments();
 if ($appointments !== null) {
     foreach ($appointments as $appointment) {
         echo "<div>";
         print_r($appointment);
         echo "</div>";
     }
 } else {
     echo "No se encontraron citas.";
 } */

//  $appointments = Route::update();
//  if ($appointments !== null) {
//     foreach ($appointments as $appointment) {
//         echo "<div>";
//         print_r($appointment);
//         echo "</div>";
//     }
// } else {
//     echo "No se encontraron citas.";
// }