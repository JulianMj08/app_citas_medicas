<?php

require_once 'Conexion.php';
class ProfileClientModel {

    // --------------------------------- VER USUARIOS -----------------------------------------
    public static function seeUserModel() {
        $conexion = Conexion::connect();
          $id = 12;  
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
    }

?>