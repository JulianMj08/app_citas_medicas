<?php
require_once __DIR__ . '/../models/AppointmentsAdminModel.php';
require_once __DIR__ . '/../models/Conexion.php';

class AppointmentsAdminController {

    public $method;

    public function seeAllUsersControl() {

        $method = $_SERVER['REQUEST_METHOD'];

        
        if($method === 'GET') {
            $allUsers = AppointmentsAdminModel::seeAllUsersModel();
            if($allUsers !== null) {
                // Establecer el encabezado para devolver JSON
                ob_clean(); // Limpiamos cualquier salida previa (muy importante)
                // Devolver las citas como JSON
                header('Content-Type: application/json');
                echo json_encode($allUsers);
                exit();
            } else {
                // Si no hay citas, devolver un mensaje de error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se Usuarios']);
            }
        }
    }

    public function seeAllAppointmentsControl() {

        $method = $_SERVER['REQUEST_METHOD'];

        
        if($method === 'GET') {
            $allAppointments = AppointmentsAdminModel::seeAllAppointmentsModel();
            if($allAppointments !== null) {
                // Establecer el encabezado para devolver JSON
                ob_clean(); // Limpiamos cualquier salida previa (muy importante)
                // Devolver las citas como JSON
                header('Content-Type: application/json');
                echo json_encode($allAppointments);
                exit();
            } else {
                // Si no hay citas, devolver un mensaje de error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se encontraron citas']);
            }
        }
    }

// ------------------------------------------------------------------------------------------------------
    public function deleteAppointmentId($id) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'DELETE') {
            $appointmentDelete = AppointmentsAdminModel::deleteAppointment($id);
            if($appointmentDelete !== null) {
                ob_clean();
                header('Content-Type: application/json');
                if($appointmentDelete) {
                    echo json_encode(['success' => 'Cita eliminada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo eliminar la Cita']);
                }
                exit();
            } 
        }
    }

// ------------------------------------------------------------------------------------------------------
    public function createAppointmentControl() {
  
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            $nameUser = $data['nameUser'] ?? null;
            $motivoAppointment = $data['motivoAppointment'] ?? null;
            $dateAppointment = $data['dateAppointment'] ?? null;

            // Verifica si todos los datos requeridos están presentes
            if ($nameUser && $motivoAppointment && $dateAppointment) {
                
                $appointmentCreate = AppointmentsAdminModel::createAppointment($nameUser, $motivoAppointment, $dateAppointment); // Llamar al modelo para crear la cita

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

    public function updateAppointmentControl($idCita, $nombre, $apellidos, $telefono, $motivoCita, $fechaCita) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'PUT') {
            $appointmentUpdate = AppointmentsAdminModel::updateAppointmentModel($idCita, $nombre, $apellidos, $telefono, $motivoCita, $fechaCita);


            if (!$nombre || !$apellidos || !$telefono || !$motivoCita || !$fechaCita) {
                error_log("Algunos campos están vacíos o no válidos.");
                echo json_encode(['error' => 'Todos los campos son obligatorios.']);
                http_response_code(400);
                exit();
            }
            if($appointmentUpdate !== null) {
                ob_clean();
                header('Content-Type: application/json');

                if($appointmentUpdate) {
                    echo json_encode(['success' => 'Noticia Actualizada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo Actualizar la noticia']);
                }
                exit();
            }
        }

    }


}

?>