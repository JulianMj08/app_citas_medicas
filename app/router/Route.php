<?php
class Route {

    private static $routes = []; // declaramos un array vacio el cual contendra los diferentes metodos [GET], [POST], etc y otras propiedades que utilizaremos


    /**
     * funcion para asignar el calback a la ruta mediante metodo GET
     *
     * @param [type] $url
     * @param [type] $callback
     * @return callback que es la url
     */
    public static function get($url, $callback) {
        self::$routes['GET'][$url] = $callback;
        $url = trim($url, '/');
    }

    /**
     * funcion para asignar el callback a la ruta mediante metodo POST
     *
     * @param [type] $url
     * @param [type] $callback
     * @return callback que es la url
     */
    public static function post($url, $callback) {
        self::$routes['POST'][$url] = $callback;
        $url = trim($url, '/');
    }

    /**
     * envía URL
     *
     * @return url aplicando el callback
     */
     public static function dispatch() {       
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/'); // quitamos el '/' que viene al comenzar la ruta
        if ($url === '') {
            $url = '/'; // Si es cadena vacía, trátala como '/'
        }
        $method = $_SERVER['REQUEST_METHOD']; // vemos el method por medio de REQUEST_METHOD
        if (isset(self::$routes[$method])) {  // si existe el method en el array de routes haz lo siguiente
            foreach (self::$routes[$method] as $route => $callback) { // recorre el array 
                if ($route === $url) {              // si el method que viene es exactamente igual a la url
                    call_user_func($callback);      // con la función call_user_func invocamos el callback
                    return;                     // retorname el callback.
                }
            }
        }
        echo '404 Not Found'; 
    } 

    /**
     * Undocumented function
     *
     * @param [type] $view
     * @return la vista segun la url solicitada.
     */
    public static function render($view) {
        include __DIR__ . '/../views/' . $view . '.php';
    }

}

?>