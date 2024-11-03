<?php

require_once 'Conexion.php';
class RegisterModel {

    public static function isUserExists($email) {
        $conexion = Conexion::connect();
        if ($conexion->connect_error) {
            echo "Error en la conexión: " . $conexion->connect_error;
            return false;
        }

        $sql = "SELECT idUser FROM users_data WHERE email = ?";
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            echo "Error preparando la consulta de verificación: " . $conexion->error;
            return false;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0; // Retorna verdadero si el email del usuario ya existe
    }

    public static function insertUser($nombre, $apellidos, $email, $telefono, $fechaNacimiento, $direccion, $sexo, $usuario, $contrasena) {
        
        $conexion = Conexion::connect();
        if ($conexion->connect_error) {
            echo "Error en la conexión: " . $conexion->connect_error;
            return false;
        }

        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fechaNacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)"; // Inserción en la tabla users_data
        $result = $conexion->prepare($sql);

        if (!$result) {
            echo "Error preparando la consulta de users_data: " . $conexion->error;
            return false;
        }

        $result->bind_param("sssssss", $nombre, $apellidos, $email, $telefono, $fechaNacimiento, $direccion, $sexo);
        
        if (!$result->execute()) {
            echo "Error en la ejecución de la inserción en users_data: " . $result->error;
            return false;
        }

        $lastId = $conexion->insert_id; // Obtener el ID del último usuario insertado
        if (!$lastId) {
            echo "Error: No se obtuvo el ID del último usuario.";
            return false;
        }

        $sql2 = "INSERT INTO users_login (idUsuario, usuario, contrasena, rol) VALUES (?, ?, ?, ?)"; // Inserción en la tabla users_login
        $result2 = $conexion->prepare($sql2);
        
        if (!$result2) {
            echo "Error preparando la consulta de users_login: " . $conexion->error;
            return false;
        }

        $rol = 'user';
        $result2->bind_param("isss", $lastId, $usuario, $contrasena, $rol);
        
        if (!$result2->execute()) {
            echo "Error en la ejecución de la inserción en users_login: " . $result2->error;
            return false;
        }
        return $lastId; // Retornar el ID del usuario registrado exitosamente
    }
}
?>