<?php
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
        // Log para diagnóstico
        error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);
        error_log("Parsed URL: " . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    
        // Procesar la URL
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/'); // Quitamos el '/' al comienzo y al final
    
        if ($url === '') {
            $url = '/'; // Si la cadena es vacía, trátala como '/'
        }
    
        $method = $_SERVER['REQUEST_METHOD']; // Obtenemos el método HTTP
        if (isset(self::$routes[$method])) { // Si existen rutas para este método
            foreach (self::$routes[$method] as $route => $callback) { // Recorremos las rutas
                // Log de la ruta y el regex generado
                $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);
                $routeRegex = str_replace('/', '\/', $routeRegex);
                $routeRegex = '/^' . $routeRegex . '$/';
                error_log("Route Regex: " . $routeRegex);
                error_log("URL to match: " . $url);
    
                // Coincidencia de regex con la URL
                if (preg_match($routeRegex, $url, $matches)) {
                    array_shift($matches); // Eliminamos el primer valor del array (la URL completa)
                    if (is_callable($callback)) {
                        call_user_func_array($callback, $matches); // Ejecutamos el callback con los parámetros
                        return;
                    } else {
                        error_log("Callback not callable for route: " . $route);
                    }
                }
            }
        }
    
        // Si no coincide ninguna ruta
        echo '404 Not Found';
    }
     

    public static function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
    }

}

?>