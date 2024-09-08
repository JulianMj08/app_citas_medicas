<?php

include 'Conexion.php';
class RegisterModel {

   /* public static function muestra(){
        $a = 1;
        $b = 2;
        $total = $a + $b;
        echo $total;
    }
*/

    public static function insertUser($nombre, $apellidos){

        $conexion = Conexion::connect();
        $sql = "INSERT INTO prueba (nombre, apellidos) values ('$nombre', '$apellidos')";

        $resultado = $conexion->query($sql);
    }
}

?>