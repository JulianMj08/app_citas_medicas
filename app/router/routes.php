<?php
//session_start();
use app\controllers\LoginController;
use app\controllers\RegisterController;

require_once 'Route.php';
//require_once '/../controllers/RegisterController';
require_once __DIR__ . '/../controllers/RegisterController.php';
require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/NoticeAdminController.php';
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



Route::get('show', function() {
    Route::render('show_image');
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



/*Route::get('uploads/{filename}', function($filename) {
    // Define la ruta completa a la carpeta de uploads
    $filePath = __DIR__ . '/../uploads/' . $filename;

    // Verificar si el archivo proporcionado existe
    if (!file_exists($filePath)) {
        // Si no existe con la extensión proporcionada, intenta con '.jpg'
        $filePathJpg = __DIR__ . '/../uploads/' . $filename . '.jpg';
        if (file_exists($filePathJpg)) {
            $filePath = $filePathJpg;
        } else {
            // Si tampoco existe con '.jpg', intenta con '.jpeg'
            $filePathJpeg = __DIR__ . '/../uploads/' . $filename . '.jpeg';
            if (file_exists($filePathJpeg)) {
                $filePath = $filePathJpeg;
            } else {
                // Si no se encuentra el archivo con ninguna extensión
                echo "Archivo no encontrado.";
                exit;
            }
        }
    }

    // Depuración: Mostrar la ruta generada
    echo "Ruta generada: $filePath <br>";

    // Verificar si el archivo existe (debería existir en este punto)
    if (file_exists($filePath)) {
        ob_clean();
        header('Content-Type: image/jpeg'); // Cambia esto si el archivo no es JPEG
        readfile($filePath);
        exit;
    } else {
        echo "Archivo no encontrado.";
        exit;
    }
});
*/

/*
Route::get('uploads/{filename}', function($filename) {
    // Verificar si $filename tiene una extensión
   /* $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif']; // Tipos de archivos permitidos
    $hasExtension = false;

    foreach ($allowedExtensions as $ext) {
        if (str_ends_with($filename, '.' . $ext)) {
            $hasExtension = true;
            break;
        }
    }

    // Si el archivo no tiene extensión, asume '.jpeg' (o lo que corresponda)
    if (!$hasExtension) {
        $filename .= '.jpeg'; // Ajusta según la extensión de tu archivo
    } 

    // Define la ruta completa a la carpeta de uploads
    $filePath = __DIR__ . '/../uploads/' . urldecode($filename); // Decodificar el nombre del archivo

    //$filePath = 'C:/laragon/www/App_citas_medicas/uploads/' . urldecode($filename);

    // Para depuración
    echo "Buscando archivo en: $filePath <br>";
    print_r($filename);
    var_dump($filename);

    // Verifica si el archivo existe
    if (file_exists($filePath)) {
        // Obtener el tipo MIME del archivo
        $mimeType = mime_content_type($filePath);
        header('Content-Type: ' . $mimeType); // Cambia esto si usas otro tipo de imagen

        readfile($filePath); // Lee el archivo y lo envía al navegador
        exit; // Detiene la ejecución del script
    } else {
        // Maneja el error si el archivo no existe
        header("HTTP/1.0 404 Not Found");
        echo "Archivo no encontrado.";
        exit;
    }
}); */



/*
Route::get('uploads/{filename}', function($filename) {
    // Define la ruta completa a la carpeta de uploads
    if (!preg_match('/\.(jpeg|jpg)$/i', $filename)) {
        //$filename .= '.jpeg';
        $filename .= '.jpg'; 
    }
    $filePath =  __DIR__ . '/../uploads/' . $filename; // Decodificar el nombre del archivo

    echo $filename . '<br>';
    echo $filePath;


    // Verifica si el archivo existe
    if (file_exists($filePath)) {
        ob_clean();
        header('Content-Type: image/jpeg'); // Este encabezado debe ser lo primero que se envía
        readfile($filePath); // Lee el archivo y lo envía directamente al navegador
        echo "Archivo encontrado. Puedes encontrar la imagen en la ruta mostrada arriba.<br>";
        //echo "Archivo encontrado. Puedes encontrar la imagen en la ruta mostrada arriba.<br>";
        // Obtener el tipo MIME del archivo
        //$mimeType = mime_content_type($filePath);
        //header('Content-Type: ' . $mimeType); // Cambia esto si usas otro tipo de imagen

        exit; // Detiene la ejecución del script
    } else {
        // Maneja el error si el archivo no existe
        header("HTTP/1.0 404 Not Found");
        echo "Archivo no encontrado.";
        exit;
    }
}); */

/*
Route::get('uploads/{filename}', function($filename) {
    // Define la ruta completa a la carpeta de uploads usando la concatenación normal
    $filePath = __DIR__ . '\\..\\uploads\\' . $filename;

    // Depuración: Mostrar la ruta generada
    echo "Ruta generada antes de realpath: $filePath <br>";

    // Usa realpath() para verificar si la ruta es válida
    $realPath = realpath($filePath);
    echo "Ruta generada después de realpath: $realPath <br>";
    var_dump($realPath);
    
    // Verificar si la ruta es válida
    if (file_exists($filePath)) {
        ob_clean();
        header('Content-Type: image/jpeg'); // Cambia esto si el archivo no es JPEG
        readfile($filePath);
        exit;
    } else {
        echo "Archivo no encontrado.";
        exit;
    }
}); 

/*
Route::get('uploads/{filename}', function($filename) {
    // Define la ruta completa a la carpeta de uploads usando DIRECTORY_SEPARATOR
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;

    // Depuración: Mostrar la ruta generada
    echo "Ruta generada antes de realpath: $filePath <br>";

    // Usa realpath() para verificar si la ruta es válida
    $realPath = realpath($filePath);
    echo "Ruta generada después de realpath: " . ($realPath ? $realPath : 'Ruta no válida') . "<br>";
    
    // Verificar si la ruta es válida
    if (file_exists($filePath)) {
        ob_clean();
        header('Content-Type: image/jpeg'); // Cambia esto si el archivo no es JPEG
        readfile($filePath);
        exit;
    } else {
        echo "Archivo no encontrado.";
        exit;
    }
});
*/

?>