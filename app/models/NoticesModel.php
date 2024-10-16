<?php
require_once 'Conexion.php';
require_once 'NoticeAdminModel.php';

class NoticesModel {
    
    // --------------------------------- VER NOTICIAS -----------------------------------------
    public static function seeAll() {
        $conexion = Conexion::connect();
        return NoticeAdminModel::seeAllNotices();
    }  
}
?>