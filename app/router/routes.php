<?php
//session_start();
use app\controllers\LoginController;
use app\controllers\RegisterController;

require_once 'Route.php';
//require_once '/../controllers/RegisterController';
require_once __DIR__ . '/../controllers/RegisterController.php';
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/NoticeAdminController.php';
require_once __DIR__ . '/../controllers/AppointmentsAdminController.php';
require_once __DIR__ . '/../controllers/UsersAdminController.php';
require_once __DIR__ . '/../controllers/NoticesController.php';
// Lista de rutas que tiene la aplicación

Route::get('/', function() {
     header('location: home', true, 301);// redirecion a el Home por medio de un header, damos true y 301 para que sea permanente
     exit(); // es buena practica dar exit para evitar errores.

    echo "desde el index";
});

Route::get('home', function() {
    Route::render('home');
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

Route::get('appointmentsAdmin', function(){
    Route::render('/admin/appointmentsAdmin');
});

Route::get('usersAdmin', function(){
    Route::render('/admin/usersAdmin');
});

Route::get('controlPanel', function(){
    Route::render('/admin/controlPanel');
});

Route::get('notices', function(){
    Route::render('notices');
});

// ------------------------------  Rutas para la API  ------------------------------ 

Route::get('api/notices', function(){
    $allNotices = new NoticesController;
    $allNotices->seeAllNoticesControl();
});

Route::post('api/noticesAdmin', function(){
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

    $noticeAdminCreate = new NoticeAdminController;
    $noticeAdminCreate->createNewNotice($title, $image, $text, $createDate, $idUsuario);
}); 

Route::get('api/noticesAdmin', function(){
    $noticesAdmin = new NoticeAdminController();
    $noticesAdmin->seeAll();
});

Route::get('api/noticesAdmin/{id}', function($id){ // Para obtener el id dinamicamente debemmos colocarlo como para metro en la funcion
    $noticeAdminId = new NoticeAdminController();
    $noticeAdminId->seeNoticeId($id);  // tambien se pasa el id como parámetro
});

Route::delete('api/noticesAdmin/{id}', function($id) {
    $noticeAdminDelete = new NoticeAdminController();
    $noticeAdminDelete->deleteNoticeId($id);
});

Route::update('api/noticesAdmin/{id}', function($id) {
    $data = json_decode(file_get_contents("php://input"), true);
    $newTitle = isset($data['titulo']) ? $data['titulo'] : null;
    $newTexto = isset($data['texto']) ? $data['texto'] : null;

    if ($newTexto) {
        $noticeAdminUpdate = new NoticeAdminController();
        $noticeAdminUpdate->updateNoticeTexto($id, $newTitle, $newTexto);
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Noticia actualizada correctamente.']);
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => 'El campo texto es requerido.']);
    }
});

Route::get('uploads/{filename}', function($filename) {
    // Define la ruta completa a la carpeta de uploads
    $filePath = __DIR__ . '/../uploads/' . $filename;

    // Verificar si el archivo proporcionado existe
    if (!file_exists($filePath)) {
        // Si no existe con la extensión proporcionada, intenta con '.jpg'
        $filePathJpg = __DIR__ . '/../uploads/' . $filename . '.jpg';
        if (file_exists($filePathJpg)) {
            $filePath = $filePathJpg; // Asignar la ruta JPG
        } else {
            // Si tampoco existe con '.jpg', intenta con '.jpeg'
            $filePathJpeg = __DIR__ . '/../uploads/' . $filename . '.jpeg';
            if (file_exists($filePathJpeg)) {
                $filePath = $filePathJpeg; // Asignar la ruta JPEG
            } else {
                // Si no se encuentra el archivo con ninguna extensión
                header("HTTP/1.0 404 Not Found"); // Configura la cabecera HTTP para 404
                echo "Archivo no encontrado."; // Mensaje de error
                exit; // Detener el script
            }
        }
    }

    // Depuración: Mostrar la ruta generada
    echo "Ruta generada: $filePath <br>";

    // Verificar si el archivo existe (debería existir en este punto)
    if (file_exists($filePath)) {
        ob_clean();
        header('Content-Type: image/jpeg'); // Cambia esto si el archivo no es JPEG
        readfile($filePath); // Lee el archivo y lo envía al navegador
        exit; // Detener el script
    } else {
        header("HTTP/1.0 404 Not Found"); // Configura la cabecera HTTP para 404
        echo "Archivo no encontrado."; // Mensaje de error
        exit; // Detener el script
    }
});
 //------------------------------ AppointmentsAdmin ------------------------------------------

Route::get('api/appointmentsAdmin', function(){
    $appointmentsAdmin = new AppointmentsAdminController;
    $appointmentsAdmin->seeAllAppointmentsControl();
});

Route::get('api/appointmentsAdminUsers', function(){
    $appointmentsAdminUsers = new AppointmentsAdminController;
    $appointmentsAdminUsers->seeAllUsersControl();
});

Route::delete('api/appointmentsAdmin/{id}', function($id) {
    $appointmentAdminDelete = new AppointmentsAdminController;
    $appointmentAdminDelete->deleteAppointmentId($id);
});

Route::post('api/appointmentsAdmin', function(){
    $data = json_decode(file_get_contents('php://input'), true); // decodificamos los datos que vienen en json

    $nameUser = $data['nameUser'] ?? null;
    $motivoAppointment = $data['motivoAppointment'] ?? null;
    $dateAppointment = $data['dateAppointment'] ?? null;

    $appointmentAdmincreate = new AppointmentsAdminController;
    $appointmentAdmincreate->createAppointmentControl($nameUser, $motivoAppointment, $dateAppointment);
});

Route::delete('api/appointmentsAdmin/{id}', function($id) {
    $appointmentAdminDelete = new AppointmentsAdminController;
    $appointmentAdminDelete->deleteAppointmentId($id);
});

Route::update('api/appointmentsAdmin/{idCita}', function($idCita) {
    
    $data = json_decode(file_get_contents("php://input"), true);

    var_dump(($data));

    print_r($data);
    $nombre = isset($data['nombre']) ? $data['nombre'] : null;
    $apellidos = isset($data['apellidos']) ? $data['apellidos'] : null;
    $telefono = isset($data['telefono']) ? $data['telefono'] : null;
    $motivoCita = isset($data['motivoCita']) ? $data['motivoCita'] : null;
    $fechaCita = isset($data['fechaCita']) ? $data['fechaCita'] : null;

    if ($idCita || $nombre || $apellidos || $telefono || $motivoCita || $fechaCita) {
        $appointmentAdminUpdate = new AppointmentsAdminController();
        $appointmentAdminUpdate->updateAppointmentControl($idCita, $nombre, $apellidos, $telefono, $motivoCita, $fechaCita);
        header('Content-Type: application/json');
        echo json_encode(['success' => 'cita actualizada correctamente.']);
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => 'El campo texto es requerido.']);
    }    
});

//------------------------------ UsersAdmin ------------------------------------------
Route::get('api/usersAdmin', function(){
    $usersAdmin = new UsersAdminController;
    $usersAdmin->seeAllUsersControl();
});

Route::delete('api/usersAdmin/{id}', function($id) {
    $userAdminDelete = new UsersAdminController;
    $userAdminDelete->deleteUserId($id);
});

Route::post('api/userAdmin', function(){
    $data = json_decode(file_get_contents('php://input'), true); // decodificamos los datos que vienen en json

    $name = $data['name'] ?? null;
    $lastNamesUser = $data['lastNamesUser'] ?? null;
    $nameUser = $data['nameUser'] ?? null;
    $emailUser = $data['emailUser'] ?? null;
    $passwordUser = $data['passwordUser'] ?? null;
    $addressUser = $data['addressUser'] ?? null;
    $phoneUser = $data['phoneUser'] ?? null;
    $birthdateUser = $data['birthdateUser'] ?? null;
    $sexUser = $data['sexUser'] ?? null;
    $rolUser = $data['rolUser'] ?? null;

    $appointmentAdmincreate = new UsersAdminController;
    $appointmentAdmincreate->createUserControl($name, $lastNamesUser, $nameUser, $emailUser, $passwordUser, $addressUser, $phoneUser, $birthdateUser, $sexUser, $rolUser);
});

Route::update('api/userAdmin/{idUser}', function($idUser) {
    
    $data = json_decode(file_get_contents("php://input"), true);

    var_dump(($data));

    print_r($data);
    $name = isset($data['name']) ? $data['name'] : null;
    $lastNamesUser = isset($data['lastNamesUser']) ? $data['lastNamesUser'] : null;
    $nameUser = isset($data['nameUser']) ? $data['nameUser'] : null;
    $sexUser = isset($data['sexUser']) ? $data['sexUser'] : null;
    $rolUser = isset($data['rolUser']) ? $data['rolUser'] : null;

    if ($name || $lastNamesUser || $nameUser || $sexUser || $rolUser ) {
        $userAdminUpdate = new UsersAdminController();
        $userAdminUpdate->updateUserControl($idUser, $name, $lastNamesUser, $nameUser, $sexUser, $rolUser);
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Usuario actualizadao correctamente.']);
    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => 'El campo texto es requerido.']);
    }    
});

?>