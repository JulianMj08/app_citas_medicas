<?php

echo "Funcionando Route";
/*
class Route {

    private static $routes = []; // declaramos un array vacio el cual contendra los diferentes metodos [GET], [POST], etc y otras propiedades que utilizaremos


    public static function get($url, $callback) {
        self::$routes['GET'][$url] = $callback;
        $url = trim($url, '/');
    }

    public static function post($url, $callback) {
        self::$routes['POST'][$url] = $callback;
        $url = trim($url, '/');
    }

    public static function delete($url, $callback) {
        self::$routes['DELETE'][$url] = $callback;
        $url = trim($url, '/');
    }

    public static function update($url, $callback) {
        self::$routes['PUT'][$url] = $callback;
        $url = trim($url, '/');
    }

    public static function dispatch() {       
    $url = $_SERVER['REQUEST_URI'];
    $url = trim($url, '/'); // quitamos el '/' que viene al comenzar la ruta
    if ($url === '') {
        $url = '/'; // Si es cadena vacía, trátala como '/'
    }
    $method = $_SERVER['REQUEST_METHOD']; // vemos el method por medio de REQUEST_METHOD
    if (isset(self::$routes[$method])) {  // si existe el method en el array de routes haz lo siguiente
        foreach (self::$routes[$method] as $route => $callback) { // recorre el array 
            $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);

            // Prepara la expresión regular para que coincida exactamente con la URL completa
            $routeRegex = str_replace('/', '\/', $routeRegex);
            $routeRegex = '/^' . $routeRegex . '$/';

            if (preg_match($routeRegex, $url, $matches)) {
                array_shift($matches); // Elimina el primer valor del array que es la URL completa
                call_user_func_array($callback, $matches); // Pasa los parámetros al callback
                return;
             if ($route === $url) {              // si el method que viene es exactamente igual a la url
                call_user_func($callback);      // con la función call_user_func invocamos el callback
                return;                    // retorname el callback.
            }
        }
    }
    echo '404 Not Found'; 
    } 

    public static function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
    }

}
*/
?>