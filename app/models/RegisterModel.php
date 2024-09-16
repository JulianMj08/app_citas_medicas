<?php

require_once 'Conexion.php';
class RegisterModel {

       public static function insertUser($nombre, $apellidos, $email, $telefono, $fechaNacimiento, $direccion, $sexo, $usuario, $contrasena){

        $conexion = Conexion::connect();
        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fechaNacimiento, direccion, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $result = $conexion->prepare($sql);

        $result->bind_param("sssssss", $nombre, $apellidos, $email, $telefono, $fechaNacimiento, $direccion, $sexo);
        $result->execute();
        $rol = 'user';

        if ($result) {
            $lastId = $conexion->insert_id;
            $sql2 = "INSERT INTO users_login (idUsuario, usuario, contrasena, rol) VALUES (?, ?, ?, ?)";
            $result2 = $conexion->prepare($sql2);
            $result2->bind_param("isss",$lastId, $usuario, $contrasena, $rol );
            $result2->execute();         
        } else {
            echo "no funciono";
        }
    }
}
?>