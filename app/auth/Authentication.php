<?php
class Authentication {

    public static function logout() {
        session_start();
        session_destroy();
        header('Location: home');
        exit();
   }
   
}

?>