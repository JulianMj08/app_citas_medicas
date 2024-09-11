<?php
namespace app\controllers;

use LoginModel;
include __DIR__ . '/../models/LoginModel.php';

class LoginController {

    // public function __construct()
    // {
    //     session_start();
    // }

    public static function loginUser() {

        if(isset($_POST['email']) && isset($_POST['contrasena'])) {

            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

            $userData = LoginModel::searchUser($email, $contrasena);

            if ($userData) {
                session_unset();
                session_start();
                $_SESSION['nombre'] = $userData['nombre'];
                $_SESSION['idUser'] = $userData['idUser'];
                $_SESSION['direccion'] = $userData['direccion'];
                $_SESSION['usuario'] = $userData['usuario'];
                
                header('location: home');
                exit();
            } else {
                echo "email no encontrado";
            }   
        }
    }
}
?>