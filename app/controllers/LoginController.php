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

        // Mostrar errores si los hay
        if (!empty($errors)) {
            Route::render('login', ['errors' => $errors]);
            return false; // Detener ejecución si hay errores
        }

        $userData = LoginModel::searchUserByEmail($email); // si no tiene errores entonces entra a validar la contraseña hasheada

        if (!$userData) {
            // Si no existe el usuario, añadir un mensaje de error
            $errors[] = "El correo electrónico que colocaste no tiene una cuenta con nosotros.";
            Route::render('login', ['errors' => $errors]);
            return false;
        }

        if ($userData && password_verify($contrasena, $userData['contrasena'])) {
            // Si la verificación de la contraseña es correcta, iniciar sesión
            return self::loginUser($userData);
        } else {
            //echo "<div style='color:red;'>Correo electrónico o contraseña incorrectos.</div>";
            $errors[] = " contraseña incorrecta.";
            Route::render('login', ['errors' => $errors]);
            return false;
        }
    }

    public static function loginUser($userData) {
        session_start(); // Iniciar la sesión
    
        $_SESSION['message'] = "¡Haz iniciado sesion correctamente!";
        // Almacenar los datos del usuario en la sesión
        $_SESSION['email'] = $userData['email']; // Almacenar el email
        $_SESSION['nombre'] = $userData['nombre']; // Almacenar el nombre
        $_SESSION['idUser'] = $userData['idUser']; // Almacenar el ID del usuario
        $_SESSION['rol'] = $userData['rol']; // Almacenar el ID del usuario


        $userRol = $_SESSION['rol'] = $userData['rol'];

        if($userRol == 'admin') {
            header('Location: home'); // Redirigir a la página de controlPanel
            exit();
        } elseif($userRol == 'user') {
            header('Location: home'); // Redirigir a la página de inicio
            exit();
        } else {
            header('Location: login');
        }
    }    
}
?>

