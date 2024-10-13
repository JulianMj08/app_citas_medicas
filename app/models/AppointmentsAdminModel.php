<?php
require_once 'Conexion.php';

class AppointmentsAdminModel {

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
            //var_dump($appointments);
            return $allAppointments;   
        } else {
            return null;
        }
    }

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

    public static function createAppointment($nameUser, $motivoAppointment, $dateAppointment) {
        $conexion = Conexion::connect();

        $getId = "SELECT idUser FROM users_data WHERE nombre = '$nameUser'";
        $getIdResult = $conexion->query($getId);

        if ($getIdResult) {
            if ($getIdResult->num_rows > 0) {
                // Obtenemos el resultado como un arreglo asociativo
                $row = $getIdResult->fetch_assoc(); //obtengo todos los datos
                $idUser = $row['idUser'];           // traigo el campo que necesito en el momento
                echo 'Datos enviados correctamente. idUser: ' . $idUser;

                $sql = "INSERT INTO citas (idUsuario, motivoCita, fechaCita) VALUES ( $idUser, '$motivoAppointment', '$dateAppointment')";
                $resultInsert = $conexion->query($sql);
            
                if($resultInsert) {
                    echo 'Datos enviados correctamente';
                } else {
                    echo 'Datos no enviados';
                };
                return $resultInsert;
                
            } else {
                echo 'No se encontraron registros con ese nombre.';
            }
            //echo 'Datos no enviados';
        };
        //return $getIdResult;
    }  

    public static function updateAppointmentModel($idCita,$nombre, $apellidos, $telefono, $motivoCita, $fechaCita) {
        $conexion = Conexion::connect();

        $nombre = $conexion->real_escape_string($nombre);
        $apellidos = $conexion->real_escape_string($apellidos);
        $telefono = $conexion->real_escape_string($telefono);
        $motivoCita = $conexion->real_escape_string($motivoCita);
        $fechaCita = $conexion->real_escape_string($fechaCita);


        $sql = "UPDATE citas c
                JOIN users_Data u ON c.idUsuario = u.idUser
                SET u.nombre = '$nombre',
	                u.apellidos = '$apellidos',
                    u.telefono = '$telefono',
                    c.motivoCita = '$motivoCita',
                    c.fechaCita = '$fechaCita'
                WHERE c.idCita = $idCita ";

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