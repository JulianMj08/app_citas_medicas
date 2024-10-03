<?php

require_once 'Conexion.php';
//echo "encendido noticias";
class NoticeAdminModel {

    // ---------------------------------------   VER TODAS LAS NOTICIAS MODELO   ---------------------------------------
    public static function seeAllNotices() {
        $conexion = Conexion::connect();
        $sql = "SELECT * FROM noticias";
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

    // ---------------------------------------   VER NOTICIAS POR MODELO   ---------------------------------------
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

    // ---------------------------------------   ELIMINAR NOTICIAS MODELO   ---------------------------------------
    public static function deleteNotice($id) {
        $conexion = Conexion::connect();
        $sql = "DELETE FROM noticias WHERE idNoticia = $id";
        $result = $conexion->query($sql);

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }
        //Para el delete no necesitamos obtener un array
    }

    // ---------------------------------------   ACTUALIZAR NOTICIAS MODELO   ---------------------------------------
    public static function updateNotice($id, $newTitle, $newTexto) {
        $conexion = Conexion::connect();
        $newTexto = $conexion->real_escape_string($newTexto);
        $newTitle = $conexion->real_escape_string($newTitle);
        $id = intval($id); // Asegurarse de que $id sea un entero

        $sql = "UPDATE noticias SET titulo = '$newTitle', texto = '$newTexto' WHERE idNoticia = $id";
        $result = $conexion->query($sql);

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }
    }

    // ---------------------------------------   CREAR NOTICIA MODELO   ---------------------------------------
    public static function createNotice($title, $image, $text, $createDate, $idUsuario) {
        $conexion = Conexion::connect();
        $sql = "INSERT INTO noticias (titulo, imagen, texto, fecha, idUsuario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $result = $stmt->execute([$title, $image, $text, $createDate, $idUsuario]);
    
        if($result) {
            echo 'Datos enviados correctamente';
        } else {
            echo 'Datos no enviados';
        };
        return $result;
    }
}
?>