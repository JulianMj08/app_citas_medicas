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
}
// $controller = new NewsAdminController();
// $controller->seeAll();
?>