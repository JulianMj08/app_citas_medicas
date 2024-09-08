<?php
namespace app\controllers;

include __DIR__ . '/../models/RegisterModel.php';

use RegisterModel;

class RegisterController {
    /* public static function verDatos() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir los valores del formulario
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'No nombre';
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : 'No apellidos';

            // Redirigir a login.php con los valores como parámetros GET
            header("Location: login.php?nombre=" . urlencode($nombre) . "&apellidos=" . urlencode($apellidos));
            exit(); // Asegurar que el script termine después de la redirección
        }
    }*/
    // public function __construct()
    // {
    //     session_start(); 
    // }

    public static function registerUsuario(){
        
// Asegúrate de iniciar la sesión al principio del archivo

    // Guardar los datos del formulario en la sesión
    $nombre = $_SESSION['nombre'] = $_POST['nombre'];
    $apellidos = $_SESSION['apellidos'] = $_POST['apellidos'];
    //$_SESSION['email'] = $_POST['email'];
    // ... otros campos del formulario
    RegisterModel::insertUser($nombre, $apellidos);

    // Redirigir a login después de guardar los datos
    //header('Location: login');
    exit();
    }
      
}

?>