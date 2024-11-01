<?php
require_once __DIR__ . '/../models/AppointmentsClientModel.php';
require_once __DIR__ . '/../models/Conexion.php';
class AppointmentsClientController {

    // --------------------------------- CREAR CITA -----------------------------------------
    public function createAppointmentControl() {
  
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            //$idUser = $data['idUser'] ?? null;
            $motivoAppointment = $data['motivoAppointment'] ?? null;
            $dateAppointment = $data['dateAppointment'] ?? null;

            // Verifica si todos los datos requeridos están presentes
            if ( $motivoAppointment && $dateAppointment) {
                
                $appointmentCreate = AppointmentsClientModel::createAppointmentModel($motivoAppointment, $dateAppointment); // Llamar al modelo para crear la cita

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

    // --------------------------------- VER CITAS -----------------------------------------
    public function seeAllAppointmentsControl() {

        //session_start();

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $allAppointments = AppointmentsClientModel::seeAllAppointmentsModel();
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

    // --------------------------------- ELIMINAR CITA -----------------------------------------
    public function deleteAppointmentId($id) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'DELETE') {
            $appointmentDelete = AppointmentsClientModel::deleteAppointment($id);
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

    // --------------------------------- ACTUALIZAR CITA -----------------------------------------
    public function updateAppointmentControl($idCita, $motivoCita, $fechaCita) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'PUT') {
            $appointmentUpdate = AppointmentsClientModel::updateAppointmentModel($idCita, $motivoCita, $fechaCita);

            if (!$motivoCita || !$fechaCita) {
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