<?php
session_start();
use app\controllers\RegisterController;


require_once 'Route.php';
//require_once '/../controllers/RegisterController';
require_once __DIR__ . '/../controllers/RegisterController.php';
// Lista de rutas que tiene la aplicación

Route::get('/', function() {
     header('location: home', true, 301);// redirecion a el Home por medio de un header, damos true y 301 para que sea permanente
     exit(); // es buena practica dar exit para evitar errores.

    echo "desde el index";
});

Route::get('home', function() {
    Route::render('home');
});


Route::get('news', function() {
    Route::render('news');
});

Route::get('register', function() {
    Route::render('register');
});

Route::post('register', function() {
    /* session_start();  // Asegúrate de iniciar la sesión al principio del archivo

    // Guardar los datos del formulario en la sesión
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['apellidos'] = $_POST['apellidos'];
    $_SESSION['email'] = $_POST['email'];
    // ... otros campos del formulario

    // Redirigir a login después de guardar los datos
    header('Location: login');
    exit(); */
    //RegisterController::register();
    RegisterController::registerUsuario();

});

Route::get('login', function() {
    Route::render('login');
});


?>