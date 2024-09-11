<?php
require_once 'Conexion.php';
class LoginModel {

    public static function searchUser($email, $contrasena) {
        
        $conexion = Conexion::connect();
        $sqlSentencia = 
        "SELECT * FROM users_data
        INNER JOIN users_login ON users_data.idUser = users_login.idUsuario
        WHERE email = '$email' AND contrasena = '$contrasena'";

        $result = $conexion->query($sqlSentencia);     

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();
            return $user;
           
        } else {
            return false;
        }
    }
}
?>