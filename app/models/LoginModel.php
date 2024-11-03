<?php
require_once 'Conexion.php';
class LoginModel {

    public static function searchUserByEmail($email) {

        $conexion = Conexion::connect();
        $sql = "SELECT users_data.nombre, users_data.idUser, users_login.contrasena, users_login.rol FROM users_data
        INNER JOIN users_login ON users_data.idUser = users_login.idUsuario
        WHERE email = ?";

        $result = $conexion->prepare($sql);
        $result->bind_param("s", $email);     
        $result->execute();
        
        $res = $result->get_result();

        if ($res->num_rows > 0) {
            return $res->fetch_assoc(); // aca esta devolviendo un array con los datos del usuario incluido la contraseña           
        } else {
            return false;
        }
    }
}
?>