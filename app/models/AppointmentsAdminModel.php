<?php
require_once 'Conexion.php';

class AppointmentsAdminModel {

    // --------------------------------- VER CITAS -----------------------------------------
    public static function seeAllAppointmentsModel() {
        $conexion = Conexion::connect();
          $sql = "SELECT * FROM citas
                  INNER JOIN users_data ON citas.idUsuario = users_data.idUser";
        $result = $conexion->query($sql);
        $allAppointments = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $allAppointments[] = $row; // Añadir cada fila al array
            }
            return $allAppointments;   
        } else {
            return null;
        }
    }

    // --------------------------------- VER USUARIOS -----------------------------------------
    public static function seeAllUsersModel() {
        $conexion = Conexion::connect();
        $sql = "SELECT nombre FROM users_data
                ORDER BY nombre ASC";
        
        $result = $conexion->query($sql);
        $allUsers = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $allUsers[] = $row; // Añadir cada fila al array
            }
            return $allUsers;   
        } else {
            return null;
        }
    }
    // --------------------------------- ELIMINAR CITA -----------------------------------------
    public static function deleteAppointment($id) {
        $conexion = Conexion::connect();
        $sql = "DELETE FROM citas WHERE idCita = ?";
        $result = $conexion->prepare($sql);
        $result->bind_param("i", $id);
        $result->execute();

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }
        //Para el delete no necesitamos obtener un array
    }

    // --------------------------------- CREAR CITA -----------------------------------------
    public static function createAppointment($nameUser, $motivoAppointment, $dateAppointment) {
        $conexion = Conexion::connect();
    
        // Preparamos la consulta para obtener el ID del usuario
        $getId = "SELECT idUser FROM users_data WHERE nombre = ?";
        $getIdResult = $conexion->prepare($getId);
        $getIdResult->bind_param("s", $nameUser);
        $getIdResult->execute();
    
        // Obtener el resultado de la consulta
        $result = $getIdResult->get_result();
    
        // Verificamos si la consulta devolvió alguna fila
        if ($result && $result->num_rows > 0) {
            // Obtenemos el resultado como un arreglo asociativo
            $row = $result->fetch_assoc();
            $idUser = $row['idUser']; // Traemos el campo necesario en este momento
            echo 'Datos obtenidos correctamente. idUser: ' . $idUser;
    
            // Preparamos la consulta para insertar la cita
            $sql = "INSERT INTO citas (idUsuario, motivoCita, fechaCita) VALUES (?, ?, ?)";
            $resultInsert = $conexion->prepare($sql);
            $resultInsert->bind_param("iss", $idUser, $motivoAppointment, $dateAppointment);
            $resultInsert->execute();
    
            if($resultInsert) {
                echo 'Cita creada correctamente';
            } else {
                echo 'Error al crear la cita';
            }
            return $resultInsert;
    
        } else {
            echo 'No se encontraron registros con ese nombre.';
        }
        // Cerramos la conexión
        $getIdResult->close();
        $conexion->close();
    }
     
    // --------------------------------- ACTUALIZAR CITA -----------------------------------------
    public static function updateAppointmentModel($idCita, $nombre, $apellidos, $telefono, $motivoCita, $fechaCita) {
        $conexion = Conexion::connect();
    
        // Escapar los valores para evitar inyecciones SQL
        $nombre = $conexion->real_escape_string($nombre);
        $apellidos = $conexion->real_escape_string($apellidos);
        $telefono = $conexion->real_escape_string($telefono);
        $motivoCita = $conexion->real_escape_string($motivoCita);
        $fechaCita = $conexion->real_escape_string($fechaCita);
    
        $sql = "UPDATE citas c
                JOIN users_Data u ON c.idUsuario = u.idUser
                SET u.nombre = ?,
                    u.apellidos = ?,
                    u.telefono = ?,
                    c.motivoCita = ?,
                    c.fechaCita = ?
                WHERE c.idCita = ?";
    
        $result = $conexion->prepare($sql);
    
        if ($result) {
            // Vincular los parámetros
            $result->bind_param("sssssi", $nombre, $apellidos, $telefono, $motivoCita, $fechaCita, $idCita);
            
            // Ejecutar la consulta y verificar si tuvo éxito
            if ($result->execute()) {
                $result->close();
                return true; // Actualización exitosa
            } else {
                error_log("Error al ejecutar la consulta SQL: " . $result->error); // Log de errores en la ejecución
                $result->close();
                return false; // Ejecución fallida
            }
        } else {
            error_log("Error en la preparación de la consulta SQL: " . $conexion->error); // Log de errores en la preparación
            return false; // Preparación fallida
        }
    }  
}
?>