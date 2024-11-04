<?php

require_once 'Conexion.php';
//echo "encendido noticias";
class NoticeAdminModel {

    // --------------------------------- VER NOTICIAS -----------------------------------------
    public static function seeAllNotices() {
        $conexion = Conexion::connect();
        $sql = "SELECT * FROM noticias
                INNER JOIN users_data on noticias.idUsuario = users_data.idUser";
        $result = $conexion->query($sql);
        $notices = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $notices[] = $row; // Añadir cada fila al array
            }
            return $notices;
        } else {
            return null;
        }
    }

    // --------------------------------- VER NOTICIA ID -----------------------------------------
    public static function seeNotice($id) {
        $conexion = Conexion::connect();
        $sql = "SELECT * FROM noticias WHERE idNoticia = $id ";
        $result = $conexion->query($sql); // como solo necesitamos un id entonces no necesitamos crear un array

        if ($result === false) {
            return null; // Si la consulta falla, devuelve null
        }
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Devuelve la noticia como un array asociativo
        } else {
            return null; // Si no se encuentra ninguna noticia con ese ID
        }
    }

    // --------------------------------- ELIMINAR NOTICIAS -----------------------------------------
    public static function deleteNotice($id) {

        $conexion = Conexion::connect();
        $sql = "DELETE FROM noticias WHERE idNoticia = ?";
        $result = $conexion->prepare($sql);
        $result->bind_param("i", $id);
        $result->execute();

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }
        //Para el delete no necesitamos obtener un array
    }

    // --------------------------------- CREAR NOTICIA -----------------------------------------
    public static function createNotice($title, $image, $text) {

        session_start();
        if (!isset($_SESSION['idUser'])) {
            return null;
        }
        $conexion = Conexion::connect();
        $idUsuario = $_SESSION['idUser'];
        $sql = "INSERT INTO noticias (titulo, imagen, texto, fecha, idUsuario) VALUES (?, ?, ?, NOW(), ?)";
        $stmt = $conexion->prepare($sql);
        $result = $stmt->execute([$title, $image, $text, $idUsuario]);
    
        if($result) {
            echo 'Datos enviados correctamente';
        } else {
            echo 'Datos no enviados';
        };
        return $result;
    }

    // --------------------------------- ACTUALIZAR NOTICIA -----------------------------------------
    public static function updateNotice($id, $newTitle, $newTexto) {

        $conexion = Conexion::connect();
        $newTexto = $conexion->real_escape_string($newTexto);
        $newTitle = $conexion->real_escape_string($newTitle);
        $id = intval($id); // Asegurarse de que $id sea un entero

        $sql = "UPDATE noticias SET titulo = ? , texto = ? WHERE idNoticia = ?";
        $result = $conexion->prepare($sql);
        $result->bind_param("ssi", $newTitle, $newTexto, $id);
        $result->execute();

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }
    }    
}
?>