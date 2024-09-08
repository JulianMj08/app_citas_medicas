<?php
require_once '../config.php';

//echo 'Conexion funcionandooooo';


class Conexion {

    private static $conexion;

    public static function connect(){

        self::$conexion = new mysqli($_ENV['SERVIDOR'], $_ENV['USUARIO'], $_ENV['CONTRASENA'], $_ENV['BD']);

        if(self::$conexion->connect_error) {
            die("Conexion fallida: " . self::$conexion->connect_error);
        }else {
            echo "Conexion Exitosa";
        }

        return self::$conexion;
    }
} 





?>