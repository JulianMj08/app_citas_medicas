<?php
require_once 'Conexion.php';
class LoginModel {

    public static function searchUser($email, $contrasena) {
        
        $conexion = Conexion::connect();
        $sqlSentence = 
        "SELECT * FROM users_data
        INNER JOIN users_login ON users_data.idUser = users_login.idUsuario
        WHERE email = ? AND contrasena = ?";

        $result = $conexion->prepare($sqlSentence);    
        $result->bind_param("ss", $email, $contrasena);
        $result->execute(); 

        $res = $result->get_result(); // para poder aplicar mas adelante el fetch debemos utilizar el get_result() ya que con execute() obtenemos es un objeto de tipo mysqli_stmt.

        if ($res->num_rows > 0) {

            $user = $res->fetch_assoc();
            return $user;
           
        } else {
            return false;
        }
    }

    public static function verified($email) {

        $conexion = Conexion::connect();
        $sql = "SELECT contrasena FROM users_data
        INNER JOIN users_login ON users_data.idUser = users_login.idUsuario
        WHERE email = ?";

        $result = $conexion->prepare($sql);
        $result->bind_param("s", $email);     
        $result->execute();
        
        $res = $result->get_result();

        if ($res->num_rows > 0) {

            $user = $res->fetch_assoc(); // aca esta devolviendo un array con los datos de la consulta
            return $user['contrasena']; // traigo solo el dato que necesito, en este caso contrasena
           
        } else {
            return false;
        }
    }
}
?>