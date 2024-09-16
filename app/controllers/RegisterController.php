<?php
namespace app\controllers;

include __DIR__ . '/../models/RegisterModel.php';

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
            $this->errors[] = "El Campo nombre no puede estar vacío";
        } elseif (strlen($this->nombre) < 10) {
            $this->errors[] = "El Campo nombre no puede tener menos de 10 caracteres";
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/", $this->nombre)) {
            $this->errors[] = "El nombre solo puede contener letras, espacios, apóstrofes y guiones";
        }

        //validacion campo email
        if(empty($this->email)) {
            $this->errors[] = "El campo email no puede estar vacio";
        } elseif (strlen($this->email) > 30) {
            $this->errors[] = "El Campo email no puede tener mas de 30 caracteres";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "El campo Email tiene un error";
        }
        return empty($this->errors);
     }
    
    
     public function getErrors() {
        return $this->errors;
    }

    public function registerUser(){

        session_start();

         // Validar antes de registrar
         if (!$this->registerValidation()) {
            return false; // Retorna los errores si los hay
        }
        
        $hashContrasena = password_hash($this->contrasena, PASSWORD_DEFAULT); 
        RegisterModel::insertUser($this->nombre, $this->apellidos, $this->email, $this->telefono, $this->fechaNacimiento, $this->direccion, $this->sexo, $this->usuario, $hashContrasena);

        // Redirigir a login después de guardar los datos
        header('Location: home');
        exit();
    }    
}
?>