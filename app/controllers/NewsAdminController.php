<?php
require_once __DIR__ . '/../models/NewsAdminModel.php';
class NewsAdminController {

    public $method;

    public function seeAll() {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $noticias = NewsAdminModel::seeAllNews();
            if($noticias !== null) {
                // Establecer el encabezado para devolver JSON
                ob_clean(); // Limpiamos cualquier salida previa (muy importante)
                // Devolver las noticias como JSON
                header('Content-Type: application/json');
                echo json_encode($noticias);
                exit();
            } else {
                // Si no hay noticias, devolver un mensaje de error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se encontraron noticias']);
            } 
        }
    }

    public function seeNewId($id){

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $noticiaId = NewsAdminModel::seeNew($id);
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

    public function deleteNewId($id) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'DELETE') {
            $noticiaEliminada = NewsAdminModel::deleteNew($id);
            if($noticiaEliminada !== null) {
                ob_clean();
                header('Content-Type: application/json');
                //echo json_encode($noticiaEliminada);
                //exit();
                if($noticiaEliminada) {

                    echo json_encode(['success' => 'Noticia eliminada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo eliminar la noticia']);
                }
                exit();
            } 
        }
    }

    public function updateNoticeTexto($id, $newTexto) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'PUT') {
            $noticeUpdate = NewsAdminModel::updateNotice($id, $newTexto);
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


    /*public function createNewNotice($title, $text, $createDate, $idUsuario) {

        $method = $_SERVER['REQUEST_METHOD'];
    
        if ($method === 'POST') {
    
            // Validar si hay un archivo en la solicitud
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Obtener los detalles del archivo
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileSize = $_FILES['image']['size'];
                $fileType = $_FILES['image']['type'];
    
                // Crear un nuevo nombre de archivo único
                $fileNameCmps = pathinfo($fileName);
                $fileExtension = strtolower($fileNameCmps['extension']);
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    
                // Definir el directorio donde se guardará el archivo
                $uploadFileDir = './uploaded_files/';
                $dest_path = $uploadFileDir . $newFileName;
    
                // Mover el archivo a la ubicación de destino
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // El archivo se ha subido correctamente
                    $imagePath = $dest_path; // Ruta de la imagen que se almacenará en la base de datos
                    
                    // Aquí puedes llamar al modelo para guardar los datos en la base de datos
                    $noticeCreated = NewsAdminModel::createNotice($title, $imagePath, $text, $createDate, $idUsuario);
    
                    if ($noticeCreated) {
                        ob_clean();
                        header('Content-Type: application/json');
                        echo json_encode(['success' => 'Noticia creada correctamente']);
                    } else {
                        echo json_encode(['error' => 'No se pudo crear la noticia']);
                    }
                } else {
                    // Error al mover el archivo
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'No se pudo mover el archivo al directorio de destino']);
                }
            } else {
                // Error al recibir el archivo
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se recibió un archivo válido']);
            }
            
            return;
            exit();
        }
    } */
    
    /*public function createNewNotice($title, $image, $text, $createDate, $idUsuario) {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'POST') {
            $noticeCreated = NewsAdminModel::createNotice($title, $image, $text, $createDate, $idUsuario);
            if($noticeCreated) {
                ob_clean();
                header('Content-Type: application/json');

                if($noticeCreated) {

                    echo json_encode(['success' => 'Noticia creada correctamente']);
                } else {
                    echo json_encode(['error' => 'No se pudo crear la noticia']);
                }
                return;
                exit();

            }
        }
    } 
        */

        public function createNewNotice() {
            // Verificar si el método es POST
            $method = $_SERVER['REQUEST_METHOD'];

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
                $createDate = $_POST['createDate'];
                $idUsuario = $_POST['idUsuario'];
        
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

                    
                    //die();
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
                $noticeCreated = NewsAdminModel::createNotice($title, $image, $text, $createDate, $idUsuario);
        
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
          

    

    
}
?>