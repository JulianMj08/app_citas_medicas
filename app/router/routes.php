<?php
//session_start();
use app\controllers\LoginController;
use app\controllers\RegisterController;

require_once 'Route.php';
//require_once '/../controllers/RegisterController';
require_once __DIR__ . '/../controllers/RegisterController.php';
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/NewsAdminController.php';
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
});

Route::get('noticesAdmin', function(){
    Route::render('/admin/noticesAdmin');
});

// ------------------------------  Rutas para la API  ------------------------------ 


Route::post('api/noticesAdmin', function(){
    
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    var_dump($_POST);  // Muestra los datos del formulario (sin archivos)
    var_dump($_FILES); // Muestra los archivos subidos

    die(); 

    //obtener datos de la solicitud
   /* $data = json_decode(file_get_contents("php://input"), true); // Para obtener datos JSON
    $title = isset($data['title']) ? $data['title'] : null;
    $image = isset($data['image']) ? $data['image'] : null;
    $text = isset($data['text']) ? $data['text'] : null;
    $createDate = isset($data['createDate']) ? $data['createDate'] : null;
    $idUsuario = isset($data['idUsuario']) ? $data['idUsuario'] : null; */

    // Para obtener los datos de la solicitud que no son el archivo (usando $_POST)
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $text = isset($_POST['text']) ? $_POST['text'] : null;
    $createDate = isset($_POST['createDate']) ? $_POST['createDate'] : null;
    $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;

    // Para obtener el archivo (usando $_FILES)
    $image = isset($_FILES['image']) ? $_FILES['image'] : null;

    // Aquí podrías agregar lógica para mover la imagen a una ubicación específica si se subió correctamente
    if ($image && $image['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($image['name']);

        // Mueve el archivo subido al directorio destino
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            echo "El archivo se subió correctamente.\n";
        } else {
            echo "Hubo un error al mover el archivo.\n";
        }
    } else {
        echo "No se subió ningún archivo o hubo un error.\n";
    }


    $noticeAdminCreate = new NewsAdminController;
    $noticeAdminCreate->createNewNotice($title, $image, $text, $createDate, $idUsuario);
}); 

Route::get('api/noticesAdmin', function(){

    $noticesAdmin = new NewsAdminController();
    $noticesAdmin->seeAll();
});

Route::get('api/noticesAdmin/{id}', function($id){ // Para obtener el id dinamicamente debemmos colocarlo como para metro en la funcion
  
    $noticeAdminId = new NewsAdminController();
    $noticeAdminId->seeNewId($id);  // tambien se pasa el id como parámetro
});

Route::delete('api/noticesAdmin/{id}', function($id) {

    $noticeAdminDelete = new NewsAdminController();
    $noticeAdminDelete->deleteNewId($id);
});

/*Route::update('api/noticesAdmin/{id}', function($id) {

    $newTexto = isset($data['texto']) ? $data['texto'] : null;
    if($newTexto) {
        $noticeAdminUpdate = new NewsAdminController();
        $noticeAdminUpdate->updateNoticeTexto($id, $newTexto);
    }
    
}) */

Route::update('api/noticesAdmin/{id}', function($id) {
    $data = json_decode(file_get_contents("php://input"), true);
    $newTexto = isset($data['texto']) ? $data['texto'] : null;

    if ($newTexto) {
        $noticeAdminUpdate = new NewsAdminController();
        $noticeAdminUpdate->updateNoticeTexto($id, $newTexto);
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Noticia actualizada correctamente.']);
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => 'El campo texto es requerido.']);
    }
});
?>