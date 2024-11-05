<?php
require_once __DIR__ . '/../models/NoticeAdminModel.php';
class NoticeAdminController {

    public $method;

    // --------------------------------- VER NOTICIAS -----------------------------------------
    public function seeAll() {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $notices = NoticeAdminModel::seeAllNotices();
            if($notices !== null) {
                // Establecer el encabezado para devolver JSON
                ob_clean(); // Limpiamos cualquier salida previa (muy importante)
                // Devolver las noticias como JSON
                header('Content-Type: application/json');
                echo json_encode($notices);
                exit();
            } else {
                // Si no hay noticias, devolver un mensaje de error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se encontraron noticias']);
            }
        }
    }

    // --------------------------------- VER NOTICIA ID -----------------------------------------
    public function seeNoticeId($id){

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $noticiaId = NoticeAdminModel::seeNotice($id);
            if($noticiaId !== null) {
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode($noticiaId);
                exit();
            } else {
                // Si no hay noticias, devolver un mensaje de error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se encontraron noticias']);
            } 
        }
    }

    // --------------------------------- ELIMINAR NOTICIA -----------------------------------------
    public function deleteNoticeId($id) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'DELETE') {
            $noticeDelete = NoticeAdminModel::deleteNotice($id);
            if($noticeDelete !== null) {
                ob_clean();
                header('Content-Type: application/json');
                if($noticeDelete) {
                    echo json_encode(['success' => 'Noticia eliminada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo eliminar la noticia']);
                }
                exit();
            } 
        }
    }

    // --------------------------------- CREAR NOTICIA -----------------------------------------
    public function createNewNotice() {
        
        $method = $_SERVER['REQUEST_METHOD']; // Verificar si el método es POST

        if (isset($_FILES['image'])) {
            var_dump($_FILES['image']);
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo "Error al subir el archivo: " . $_FILES['image']['error'];
                die();
            }
        }
        if ($method === 'POST') {
            // Obtener los datos del formulario
            $title = $_POST['title'];
            $text = $_POST['text'];
    
            // Inicializar el valor de $image
            $image = '';

            if (isset($_FILES['image'])) {
                var_dump($_FILES['image']);
                if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                    echo "Error al subir el archivo: " . $_FILES['image']['error'];
                    die();
                }
            } else {
                echo "No se encontró el archivo en el envío del formulario";
                die();
            }
    
            // Verificar si hay un archivo en $_FILES
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

                // Configuración del directorio donde se guardarán las imágenes
                $uploadDir = __DIR__ . '/../uploads/';  // Ruta donde almacenarás las imágenes
                $imageName = basename($_FILES['image']['name']); // Obtener el nombre del archivo
                $imageName = preg_replace('/\s+/', '_', basename($_FILES['image']['name'])); // Reemplazar espacios por guiones bajos
                $imageName = time() . "_" . $imageName; // Añadir un timestamp al nombre del archivo para evitar duplicados
                $imageTmpName = $_FILES['image']['tmp_name']; // Ruta temporal del archivo
                
                // Definir la ruta completa del archivo de destino
                $uploadFile = $uploadDir . $imageName;
    
                // Mover el archivo desde la ubicación temporal a la carpeta de destino
                if (move_uploaded_file($imageTmpName, $uploadFile)) {
                    // El archivo se ha subido con éxito, guardamos el nombre del archivo
                    $image = $imageName;
                } else {
                    // Error al subir el archivo
                    echo json_encode(['error' => 'Error al subir la imagen']);
                    return;
                }
            }
    
            // Llamar al modelo para crear la noticia
            $noticeCreated = NoticeAdminModel::createNotice($title, $image, $text);
    
            // Limpiar el buffer de salida y preparar la respuesta
            ob_clean();
            header('Content-Type: application/json');
    
            // Verificar si la noticia fue creada correctamente
            if ($noticeCreated) {
                echo json_encode(['success' => 'Noticia creada correctamente']);
            } else {
                echo json_encode(['error' => 'No se pudo crear la noticia']);
            }
            return;
        }
    }

    // --------------------------------- ACTUALIZAR NOTICIA -----------------------------------------
    public function updateNoticeTexto($id, $newTitle, $newTexto) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'PUT') {
            $noticeUpdate = NoticeAdminModel::updateNotice($id, $newTitle, $newTexto);
            if($noticeUpdate !== null) {
                ob_clean();
                header('Content-Type: application/json');

                if($noticeUpdate) {
                    echo json_encode(['success' => 'Noticia Actualizada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo Actualizar la noticia']);
                }
                exit();
            }
        }
    }  
}
?>