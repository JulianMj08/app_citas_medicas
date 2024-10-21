<?php

require_once __DIR__ . '/../models/ProfileClientModel.php';
require_once __DIR__ . '/../models/Conexion.php';
class ProfileClientController {

    // --------------------------------- VER USUARIOS -----------------------------------------
    public function seeUserControl() {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $user = ProfileClientModel::seeUserModel();
            if($user !== null) {
                // Establecer el encabezado para devolver JSON
                ob_clean(); // Limpiamos cualquier salida previa (muy importante)
                // Devolver las citas como JSON
                header('Content-Type: application/json');
                echo json_encode($user);
                exit();
            } else {
                // Si no hay citas, devolver un mensaje de error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se Usuarios']);
            }
        }
    }
}
?>