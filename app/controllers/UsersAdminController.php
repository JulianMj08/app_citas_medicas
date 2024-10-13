<?php

require_once __DIR__ . '/../models/UsersAdminModel.php';
require_once __DIR__ . '/../models/Conexion.php';

class UsersAdminController {
    

    public function seeAllUsersControl() {

        $method = $_SERVER['REQUEST_METHOD'];

        
        if($method === 'GET') {
            $allUsers = UsersAdminModel::seeAllUsersModel();
            if($allUsers !== null) {
                // Establecer el encabezado para devolver JSON
                ob_clean(); // Limpiamos cualquier salida previa (muy importante)
                // Devolver las citas como JSON
                header('Content-Type: application/json');
                echo json_encode($allUsers);
                exit();
            } else {
                // Si no hay usuarios, devolver un mensaje de error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se encontraron usuarios']);
            }
        }
    }

    // --------------------------------------------------------------------------
    public function deleteUserId($id) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'DELETE') {
            $userDelete = UsersAdminModel::deleteUserModel($id);
            if($userDelete !== null) {
                ob_clean();
                header('Content-Type: application/json');
                if($userDelete) {
                    echo json_encode(['success' => 'Usuario eliminado correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo eliminar el Usuario']);
                }
                exit();
            } 
        }
    }

    // ------------------------------------------------------------------------------------------------------
    public function createUserControl() {
  
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            $name = $data['name'] ?? null;
            $lastNamesUser = $data['lastNamesUser'] ?? null;
            $nameUser = $data['nameUser'] ?? null;
            $emailUser = $data['emailUser'] ?? null;
            $passwordUser = $data['passwordUser'] ?? null;
            $addressUser = $data['addressUser'] ?? null;
            $phoneUser = $data['phoneUser'] ?? null;
            $birthdateUser = $data['birthdateUser'] ?? null;
            $sexUser = $data['sexUser'] ?? null;
            $rolUser = $data['rolUser'] ?? null;

            // Verifica si todos los datos requeridos están presentes
            if ($name || $lastNamesUser || $nameUser || $emailUser || $passwordUser || $addressUser || $phoneUser || $birthdateUser || $sexUser || $rolUser) {
                
                $appointmentCreate = UsersAdminModel::createUser($name, $lastNamesUser, $nameUser, $emailUser, $passwordUser, $addressUser, $phoneUser, $birthdateUser, $sexUser, $rolUser); // Llamar al modelo para crear la cita

                ob_clean();
                header('Content-Type: application/json');

                if ($appointmentCreate) {
                    echo json_encode(['success' => 'Cita creada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo crear la cita']);
                } 
            } else {
                // Responder si faltan datos
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Faltan datos para crear la cita']);
            }
            exit(); 
        }
    }  

    // ----------------------------------------------------------------------------------

    public function updateUserControl($idUser, $name, $lastNamesUser, $nameUser, $sexUser, $rolUser) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'PUT') {
            $userUpdate = UsersAdminModel::updateUserModel($idUser, $name, $lastNamesUser, $nameUser, $sexUser, $rolUser);


            // if (!$nombre || !$apellidos || !$telefono || !$motivoCita || !$fechaCita) {
            //     error_log("Algunos campos están vacíos o no válidos.");
            //     echo json_encode(['error' => 'Todos los campos son obligatorios.']);
            //     http_response_code(400);
            //     exit();
            // }
            if($userUpdate !== null) {
                ob_clean();
                header('Content-Type: application/json');

                if($userUpdate) {
                    echo json_encode(['success' => 'Usuario Actualizado correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo Actualizar el Usuario']);
                }
                exit();
            }
        }

    }
}



?>