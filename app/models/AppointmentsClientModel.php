<?php

require_once 'Conexion.php';
class AppointmentsClientModel {

    public static function createAppointmentModel($idUsuario, $motivoCita, $fechaCita) {

        $conexion = Conexion::connect();
        $sql = "INSERT INTO citas (idUsuario, motivoCita, fechaCita) VALUES ($idUsuario, '$motivoCita', '$fechaCita')";
        $result = $conexion->query($sql);

        if ($result) {
            echo json_encode(['success' => 'Datos enviados correctamente']);
        } else {
            echo json_encode(['error' => 'Datos no enviados']);
        }
        return $result;
    }
    
    // --------------------------------- VER CITAS -----------------------------------------
    public static function seeAllAppointmentsModel() {
        $conexion = Conexion::connect();
          $sql = "SELECT * FROM citas
                  WHERE idUsuario = 7";
        $result = $conexion->query($sql);
        $allAppointments = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $allAppointments[] = $row; // Añadir cada fila al array
            }
            //var_dump($appointments);
            return $allAppointments;   
        } else {
            return null;
        }
    }

    // --------------------------------- ELIMINAR CITA -----------------------------------------
    public static function deleteAppointment($id) {
        $conexion = Conexion::connect();
        $sql = "DELETE FROM citas WHERE idCita = $id";
        $result = $conexion->query($sql);

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }
        //Para el delete no necesitamos obtener un array
    }

    // --------------------------------- ACTUALIZAR CITA -----------------------------------------
    public static function updateAppointmentModel($idCita, $motivoCita, $fechaCita) {
        $conexion = Conexion::connect();

        $motivoCita = $conexion->real_escape_string($motivoCita);
        $fechaCita = $conexion->real_escape_string($fechaCita);

        $sql = "UPDATE citas 
                SET motivoCita = '$motivoCita',
                    fechaCita = '$fechaCita'
                WHERE idCita = $idCita ";

        $result = $conexion->query($sql);  
        
        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            error_log("Error en la consulta SQL: " . $conexion->error); // Agregar logs de errores SQL
            return false; // Si la consulta falló
        }
    }
}

?>