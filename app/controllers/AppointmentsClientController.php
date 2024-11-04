<?php
require_once __DIR__ . '/../models/AppointmentsClientModel.php';
require_once __DIR__ . '/../models/Conexion.php';
class AppointmentsClientController {

    // --------------------------------- CREAR CITA -----------------------------------------
    public function createAppointmentControl() {
        $method = $_SERVER['REQUEST_METHOD'];
    
        if ($method === 'POST') {
            // Obtener los datos de la solicitud
            $data = json_decode(file_get_contents('php://input'), true);
    
            // Variables de entrada
            $motivoAppointment = $data['motivoAppointment'] ?? null;
            $dateAppointment = $data['dateAppointment'] ?? null;
    
            // Verifica si todos los datos requeridos están presentes
            header('Content-Type: application/json'); // Configurar el encabezado para JSON
    
            if ($motivoAppointment && $dateAppointment) {
                $today = date('Y-m-d');
    
                // Verificar si la fecha es en el pasado
                if ($dateAppointment < $today) {
                    echo json_encode(['error' => 'La fecha no puede ser en el pasado.']);
                    exit(); // Salir después de enviar el mensaje de error
                }
    
                // Si la fecha es válida, intenta crear la cita
                $appointmentCreate = AppointmentsClientModel::createAppointmentModel($motivoAppointment, $dateAppointment); // Llamar al modelo para crear la cita
                
                if ($appointmentCreate) {
                    echo json_encode(['success' => 'Cita creada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo crear la cita']);
                }
            } else {
                // Responder si faltan datos
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

            // Comprobar que la cita existe
            $currentAppointment = AppointmentsClientModel::getAppointmentById($id);
            if (!$currentAppointment) {
                header('Content-Type: application/json', true, 404);
                echo json_encode(['error' => 'Cita no encontrada.']);
                exit();
            }

            // Verificar que la fecha de la cita no sea anterior a hoy
            $today = date('Y-m-d');
            if ($currentAppointment['fechaCita'] < $today) {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['error' => 'No se puede eliminar una cita que ya ha pasado.']);
                exit();
            }

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