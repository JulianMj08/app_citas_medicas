<?php

namespace app\controllers;

use LoginModel;
use Route;

include __DIR__ . '/../models/LoginModel.php';
include_once __DIR__ . '/../router/Route.php';

class LoginController {

    public static function LoginValidation() {

        $errors = [];

        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];

        if (empty($email)) {
            $errors[] = "El campo email no puede estar vacío.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Formato de email no válido.";
        }

        if (empty($contrasena)) {
            $errors[] = "El campo contraseña no puede estar vacío.";
        } elseif (strlen($contrasena) < 3) {
            $errors[] = "la contraseña debe tener al menos 3 caracteres.";
        }

        $hashedcontrasena = LoginModel::verified($email);

        if (password_verify($contrasena, $hashedcontrasena)) {
            echo "Inicio de sesión exitoso: la contraseña es correcta.";
        } else {
            echo "Error: la contraseña es incorrecta.";
        }
        foreach ($errors as $error) {
            echo "<div style='color:red;'>{$error}</div>";
        }
        

        /*if (isset($_POST['login-btn'])) {
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

            if (empty($email) || empty($contrasena)) {
                $error = " DATOS VACIOS ";
            } else {
                echo " DATOS COMPLETOS ";
                self::loginUser();
            }
        }*/
        //Route::render('login', ['error' => $error]);
    }

    public static function loginUser() {

        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $userData = LoginModel::searchUser($email, $contrasena);

        if ($userData) {
            session_start();
            $_SESSION['nombre'] = $userData['nombre'];
            $_SESSION['idUser'] = $userData['idUser'];
            $_SESSION['direccion'] = $userData['direccion'];
            $_SESSION['usuario'] = $userData['usuario'];

            header('Location: home');
            exit();
        } else {
            echo "Correo electrónico o contraseña incorrectos.";
        }
        return "no funciono";
    }     
} 
?>

