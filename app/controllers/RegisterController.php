<?php
namespace app\controllers;

include __DIR__ . '/../models/RegisterModel.php';

use DateTime;
use RegisterModel;

class RegisterController {

        private $nombre;
        private $apellidos;
        private $usuario;
        private $email;
        private $contrasena;
        private $direccion;
        private $telefono;
        private $fechaNacimiento;
        private $sexo;

        private $errors = [];

    public function __construct() {
        // Puedes inicializar las propiedades si es necesario, pero no llenarlas con $_POST.
        $this->errors = [];
    }

    public function fillFromPost() {
        $this->nombre = strtolower(htmlspecialchars($_POST['nombre'] ?? ''));
        $this->apellidos = strtolower(htmlspecialchars($_POST['apellidos'] ?? ''));
        $this->usuario = strtolower(htmlspecialchars($_POST['usuario'] ?? ''));
        $this->email = strtolower(filter_var(htmlspecialchars($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL));
        $this->contrasena = strtolower(htmlspecialchars($_POST['contrasena'] ?? ''));
        $this->direccion = strtolower(htmlspecialchars($_POST['direccion'] ?? ''));
        $this->telefono = filter_var(htmlspecialchars($_POST['telefono'] ?? ''), FILTER_SANITIZE_NUMBER_INT) ;
        $this->fechaNacimiento = htmlspecialchars($_POST['fecha-nacimiento'] ?? '');
        $this->sexo = strtoupper(htmlspecialchars($_POST['sexo'] ?? ''));
    }

    public function registerValidation() {

        //validacion campo nombre
        if(empty($this->nombre)) {
            $this->errors[] = "El Campo nombre es obligatorio";
        } elseif (strlen($this->nombre) < 3) {
            $this->errors[] = "El Campo nombre no puede tener menos de 3 carácteres";
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->nombre)) {
            $this->errors[] = "El  campo nombre solo puede contener letras, espacios, apóstrofes y guiones";
        } elseif (strlen($this->nombre) > 20) {
            $this->errors[] = "El Campo nombre no puede tener mas de 20 carácteres";
        }

        // validacion campo apellidos
        if(empty($this->apellidos)) {
            $this->errors[] = "El Campo apellidos es obligatorio";
        } elseif (strlen($this->apellidos) < 3) {
            $this->errors[] = "El Campo apellidos no puede tener menos de 3 carácteres";
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->apellidos)) {
            $this->errors[] = "El  campo apellidos solo puede contener letras, espacios, apóstrofes y guiones";
        } elseif (strlen($this->apellidos) > 30) {
            $this->errors[] = "El Campo apellidos no puede tener mas de 30 carácteres";
        }

        // validacion campo usuario
        if(empty($this->usuario)) {
            $this->errors[] = "El Campo usuario es obligatorio";
        } elseif (strlen($this->usuario) < 3) {
            $this->errors[] = "El Campo usuario no puede tener menos de 3 carácteres";
        } elseif (strlen($this->usuario) > 12) {
            $this->errors[] = "El Campo usuario no puede tener mas de 3 carácteres";
        }

        //validación campo email
        if(empty($this->email)) {
            $this->errors[] = "El campo email es obligatorio";
        } elseif (strlen($this->email) > 30) {
            $this->errors[] = "El Campo email no puede tener mas de 30 caracteres";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "El campo Email tiene un error";
        }

        //validación campo contraseña
        if(empty($this->contrasena)) {
            $this->errors[] = "El campo contraseña es obligatorio";
        } elseif (strlen($this->contrasena) > 15) {
            $this->errors[] = "El Campo contraseña no puede tener mas de 15 caracteres";
        } elseif (strlen($this->contrasena) < 8) {
            $this->errors[] = "El Campo contraseña no puede tener menos de 8 caracteres";
        }

        //validación campo telefono
        if (empty($this->telefono)) {
            $this->errors[] = "El campo telefono es obligatorio";
        } elseif (strlen($this->telefono) !== 9) {
            $this->errors[] = "El campo telefono debe tener exactamente 9 números";
        } elseif (!preg_match('/^[0-9]+$/', $this->telefono)) {
            $this->errors[] = "El campo telefono solo debe contener números";
        }
        

        //validación campo fecha de nacimiento
        $fechaActual = new DateTime();
        // var_dump($this->fechaNacimiento);
        // var_dump($fechaActual);

        if (empty($this->fechaNacimiento)) {
            $this->errors[] = "El campo fecha de nacimiento es obligatorio";
        } else {
            $fechaConvertida = new DateTime($this->fechaNacimiento);
            
            if (!$fechaConvertida) {
                $this->errors[] = "El formato de la fecha de nacimiento es incorrecto.";
            } elseif ($fechaConvertida > $fechaActual) {
                $this->errors[] = "El campo fecha de nacimiento no puede ser mayor a la fecha actual";
            } elseif (strlen($this->fechaNacimiento) < 8) {
                $this->errors[] = "El campo fecha de nacimiento no puede tener menos de 8 caracteres";
            }
        }
        
        //validación campo sexo
        if(empty($this->sexo)) {
            $this->errors[] = "El campo sexo es obligatorio";
        }
        return empty($this->errors);
     }
    
    public function getErrors() {
        return $this->errors;
    }

    public function registerUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!$this->registerValidation()) {
            echo "Error de validación: ";
            print_r($this->errors);
            return false;
        }
    
        $hashContrasena = password_hash($this->contrasena, PASSWORD_DEFAULT); 
    
        // Intentar insertar el usuario y obtener el idUser
        $idUser = RegisterModel::insertUser($this->nombre, $this->apellidos, $this->email, $this->telefono, $this->fechaNacimiento, $this->direccion, $this->sexo, $this->usuario, $hashContrasena);
    
        if ($idUser) {
            // Establece los datos en la sesión
            $_SESSION['idUser'] = $idUser;         // Almacena el idUser en la sesión
            $_SESSION['usuario'] = $this->usuario; // Nombre de usuario
            $_SESSION['rol'] = 'user';            // Rol del usuario
            $_SESSION['email'] = $this->email;     // Email del usuario

            $_SESSION['message'] = "¡Te has registrado correctamente!";
    
            //echo "Registro exitoso, ID de usuario: " . $_SESSION['idUser'];
            
            // Redirigir al usuario a home
            header('Location: home');
            exit();
        } else {
            header('Location: login');
            exit();
        }
    }
        
}
?>