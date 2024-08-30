<?php
require_once 'Route.php';
// Lista de rutas que tiene la aplicación

Route::get('/', function() {
     header('location: home', true, 301);// redirecion a el Home por medio de un header, damos true y 301 para que sea permanente
     exit(); // es buena practica dar exit para evitar errores.

    echo "desde el index";
});

Route::get('home', function() {
    Route::render('home');
});

Route::get('login', function() {
    Route::render('login');
});

Route::get('news', function() {
    Route::render('news');
});

Route::get('register', function() {
    Route::render('register');
});

?>