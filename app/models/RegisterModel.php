<?php

require_once 'Conexion.php';
class RegisterModel {

       public static function insertUser($nombre, $apellidos, $email, $telefono, $fechaNacimiento, $direccion, $sexo, $usuario, $contrasena){

        $conexion = Conexion::connect();
        $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fechaNacimiento, direccion, sexo) VALUES
                        ('$nombre', '$apellidos', '$email', '$telefono', '$fechaNacimiento', '$direccion', '$sexo')";

        $resultado = $conexion->query($sql);
        $rol = 'user';

        if ($resultado == true) {
            $ultimoId = $conexion->insert_id;
            $sqlDos = "INSERT INTO users_login (idUsuario, usuario, contrasena, rol) VALUES 
                        ('$ultimoId', '$usuario', '$contrasena', '$rol')";
            $resultadoDos = $conexion->query($sqlDos);            
        } else {
            echo "no funciono";
        }
    }
}

?>