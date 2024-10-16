<?php

require_once 'Conexion.php';
class UsersAdminModel {

    // --------------------------------- VER USUARIOS -----------------------------------------
    public static function seeAllUsersModel() {
        $conexion = Conexion::connect();
          $sql = "SELECT * FROM users_data
          INNER JOIN users_login on users_data.idUser = users_login.idUsuario";
        $result = $conexion->query($sql);
        $allUsers = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $allUsers[] = $row; // Añadir cada fila al array
            }
            //var_dump($appointments);
            return $allUsers;   
        } else {
            return null;
        }
    }

    // --------------------------------- ELIMINAR USUARIO -----------------------------------------
    public static function deleteUserModel($id) {
        $conexion = Conexion::connect();
        //$sqlAppointment = "DELETE FROM citas WHERE idUsuario = $id";
        $sql = "DELETE FROM users_data WHERE idUser = $id";
        $result = $conexion->query($sql);

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }
        //Para el delete no necesitamos obtener un array
    }

    // --------------------------------- CREAR USUARIO -----------------------------------------
    public static function createUser($name, $lastNamesUser, $nameUser, $emailUser, $passwordUser, $addressUser, $phoneUser, $birthdateUser, $sexUser, $rolUser){

        $conexion = Conexion::connect();
        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fechaNacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $result = $conexion->prepare($sql);

        $result->bind_param("sssssss", $name, $lastNamesUser, $emailUser, $phoneUser, $birthdateUser, $addressUser, $sexUser);
        $result->execute();
        //$rol = 'user';

        if ($result) {
            $lastId = $conexion->insert_id;
            $sql2 = "INSERT INTO users_login (idUsuario, usuario, contrasena, rol) VALUES (?, ?, ?, ?)";
            $result2 = $conexion->prepare($sql2);
            $result2->bind_param("isss",$lastId, $nameUser, $passwordUser, $rolUser );
            $result2->execute();         
        } else {
            echo "no funciono";
        }
        return $result && $result2;
    }

  // --------------------------------- ACTUALIZAR USUARIO ----------------------------------------- 
    public static function updateUserModel($idUser, $name, $lastNamesUser, $nameUser, $sexUser, $rolUser) {
        $conexion = Conexion::connect();

        $name = $conexion->real_escape_string($name);
        $lastNamesUser = $conexion->real_escape_string($lastNamesUser);
        $nameUser = $conexion->real_escape_string($nameUser);
        $sexUser = $conexion->real_escape_string($sexUser);
        $rolUser = $conexion->real_escape_string($rolUser);

        $sql = "UPDATE users_data d
                 JOIN users_login l ON d.idUser = l.idUsuario
                 SET d.nombre = '$name',
                     d.apellidos = '$lastNamesUser',
                     d.sexo = '$sexUser',
                     l.usuario = '$nameUser',
                     l.rol = '$rolUser'
                WHERE d.idUser = $idUser ";            

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