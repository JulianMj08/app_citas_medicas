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
        $sql = "DELETE FROM users_data WHERE idUser = ?";
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

    // --------------------------------- CREAR USUARIO -----------------------------------------
    public static function createUser($name, $lastNamesUser, $nameUser, $emailUser, $passwordUser, $addressUser, $phoneUser, $birthdateUser, $sexUser, $rolUser){

        $conexion = Conexion::connect();
        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fechaNacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $result = $conexion->prepare($sql);

        $result->bind_param("sssssss", $name, $lastNamesUser, $emailUser, $phoneUser, $birthdateUser, $addressUser, $sexUser);
        $result->execute();

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
    
    // Escapar los valores para evitar inyecciones de SQL
    $name = $conexion->real_escape_string($name);
    $lastNamesUser = $conexion->real_escape_string($lastNamesUser);
    $nameUser = $conexion->real_escape_string($nameUser);
    $sexUser = $conexion->real_escape_string($sexUser);
    $rolUser = $conexion->real_escape_string($rolUser);

    $sql = "UPDATE users_data d
             JOIN users_login l ON d.idUser = l.idUsuario
             SET d.nombre = ?,
                 d.apellidos = ?,
                 d.sexo = ?,
                 l.usuario = ?,
                 l.rol = ?
            WHERE d.idUser = ?";            

    $result = $conexion->prepare($sql);

    if ($result) {
        // Vincular los parámetros
        $result->bind_param("sssssi", $name, $lastNamesUser, $sexUser, $nameUser, $rolUser, $idUser);
        
        // Ejecutar la consulta y verificar si tuvo éxito
        if ($result->execute()) {
            $result->close();
            return true; // Si la actualización fue exitosa
        } else {
            error_log("Error al ejecutar la consulta SQL: " . $result->error); // Log de errores de ejecución
            $result->close();
            return false; // Si la ejecución falló
        }
    } else {
        error_log("Error en la preparación de la consulta SQL: " . $conexion->error); // Log de errores de preparación
        return false; // Si la preparación falló
    }
}

}
?>