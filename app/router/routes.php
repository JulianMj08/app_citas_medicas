<?php
//session_start();
use app\controllers\LoginController;
use app\controllers\RegisterController;



require_once 'Route.php';
//require_once '/../controllers/RegisterController';
require_once __DIR__ . '/../controllers/RegisterController.php';
require_once __DIR__ . '/../controllers/LoginController.php';
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
    $userRegister = new RegisterController;

    // Solo llenamos los datos si el formulario fue enviado
    if (isset($_POST['register-btn'])) {
        $userRegister->fillFromPost($_POST);
    }

    // Si el registro falla por validación, muestra los errores en pantalla
    if (!$userRegister->registerUser()) {
        $errors = $userRegister->getErrors(); // Obtener los errores
        Route::render('register', ['errors' => $errors]); // Pasar los errores a la vista
    }

    

});

Route::get('login', function() {
    Route::render('login');
});

Route::post('login', function(){
    LoginController::LoginValidation();

    

    ////////$error = LoginController::loginUser();
    
    // Renderizar la página de login con el mensaje de error
    ////////Route::render('login', ['error' => $error]);
    /*$error = LoginController::loginUser();
        
        if ($error) {
            // Si hay un error, renderizar de nuevo la página de login y mostrar el mensaje
            Route::render('login', ['message' => $error]);
        } else {
            // Si no hay error, redirigir al home
            header('Location: home');
            exit();
        } */

    /*if(isset($_POST['login-btn'])){




        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];

        echo "Email " . $email;
        echo "Contraseña " . $contrasena;

        if(empty($email) || empty($contrasena)) {

            echo "<div> DATOS VACIOS </div>";

        }*/
    
});


?>