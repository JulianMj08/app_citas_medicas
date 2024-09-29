<?php

require_once 'Conexion.php';
//echo "encendido noticias";
class NewsAdminModel {


    public static function seeAllNews() {
        $conexion = Conexion::connect();
        $sql = "SELECT * FROM noticias";
        $result = $conexion->query($sql);
        $noticias = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $noticias[] = $row; // Añadir cada fila al array
            }
            return $noticias;
            //var_dump($noticias); // Devolver todas las noticias
        } else {
            return null;
        }
    }

    public static function seeNew($id) {

        $conexion = Conexion::connect();
        $sql = "SELECT * FROM noticias WHERE idNoticia = $id ";
        $result = $conexion->query($sql);
        //$noticias = [];

        if ($result === false) {
            return null; // Si la consulta falla, devuelve null
        }
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Devuelve la noticia como un array asociativo
        } else {
            return null; // Si no se encuentra ninguna noticia con ese ID
        }
    }

    public static function deleteNew($id) {

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

    public static function updateNotice($id, $newTexto) {

        $conexion = Conexion::connect();

        $newTexto = $conexion->real_escape_string($newTexto);
        $id = intval($id); // Asegurarse de que $id sea un entero

        $sql = "UPDATE noticias SET texto = '$newTexto' WHERE idNoticia = $id";
        $result = $conexion->query($sql);

        if ($result) {
            return true; // Si la eliminación fue exitosa
        } else {
            return false; // Si la consulta falló
        }

    }

    // public static function createNotice($title, $image, $text, $createDate) {

    //     $conexion = Conexion::connect();
    //     $sql = "INSERT INTO noticias (titulo, imagen, texto, fecha) VALUES ('$title', '$image', '$text', '$createDate' )";
    //     $result = $conexion->query($sql);

    //     if($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

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