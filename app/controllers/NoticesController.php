<?php

require_once __DIR__ . '/../models/NoticesModel.php';
class NoticesController {

    // --------------------------------- VER NOTICIAS -----------------------------------------
    public function seeAllNoticesControl() {
        $noticias = NoticesModel::seeAll();

        if (!empty($noticias)) {
            ob_clean();
            // Establecer el encabezado de contenido JSON
            header('Content-Type: application/json');
            echo json_encode($noticias);
        } else {
            echo json_encode(["message" => "No hay noticias disponibles."]);
        }
    }  
}

?>