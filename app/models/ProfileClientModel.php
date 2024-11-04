<?php

require_once 'Conexion.php';
class ProfileClientModel {

    // --------------------------------- VER USUARIOS -----------------------------------------
    public static function seeUserModel() {

        session_start();
        if (!isset($_SESSION['idUser'])) {
            return null;
        }
        $conexion = Conexion::connect();
        $id = $_SESSION['idUser']; // Obtén el ID del usuario de la sesión
        $sql = "SELECT * FROM users_data
                INNER JOIN users_login on users_data.idUser = users_login.idUsuario
                WHERE idUser = $id";
        $result = $conexion->query($sql);

        if ($result=== false) {
            return null;
            }
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Devuelve los datos como un array asociativo
            } else {
                return null; // Si no se encuentra ningun usuario con ese ID
            }
        
        }

    public static function updateUserProfileModel($idUser, $name, $lastNamesUser, $email, $fechaNacimiento, $direccion, $sexUser, $nameUser, $password) {

            $conexion = Conexion::connect();
            $name = $conexion->real_escape_string($name);
            $lastNamesUser = $conexion->real_escape_string($lastNamesUser);
            $email = $conexion->real_escape_string($email);
            $fechaNacimiento = $conexion->real_escape_string($fechaNacimiento);
            $direccion = $conexion->real_escape_string($direccion);
            $sexUser = $conexion->real_escape_string($sexUser);
            $nameUser = $conexion->real_escape_string($nameUser);
            $password = $conexion->real_escape_string($password);
        
            $sql = "UPDATE users_data d
                     JOIN users_login l ON d.idUser = l.idUsuario
                     SET d.nombre = ?,
                         d.apellidos = ?,
                         d.email = ?,
                         d.fechaNacimiento = ?,
                         d.direccion = ?,
                         d.sexo = ?,
                         l.usuario = ?,
                         l.contrasena = ?
                    WHERE d.idUser =  ?";
                    
            $result = $conexion->prepare($sql);
            $result->bind_param("ssssssssi", $name, $lastNamesUser, $email, $fechaNacimiento, $direccion, $sexUser, $nameUser, $password, $idUser);
            
            if ($result && $result->execute()) { // Ejecuta la consulta y verifica el éxito
                return true; // Si la actualización fue exitosa
            } else {
                error_log("Error en la consulta SQL: " . $conexion->error); // Agregar logs de errores SQL
                return false; // Si la consulta falló
            }
        }
    }
?>