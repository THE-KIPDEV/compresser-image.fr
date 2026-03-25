<?php

/**
 * Simple regex-based router
 */

function dispatch(array $routes): void
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = rtrim($uri, '/') ?: '/';

    foreach ($routes as $pattern => $handler) {
        $regex = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[a-zA-Z0-9\-_\.]+)', $pattern);
        $regex = '#^' . $regex . '$#';

        if (preg_match($regex, $uri, $matches)) {
            [$controllerName, $method] = $handler;

            $controllerFile = CONTROLLERS_PATH . '/' . $controllerName . '.php';
            if (!file_exists($controllerFile)) {
                error404();
                return;
            }

            require_once $controllerFile;
            $controller = new $controllerName();

            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            call_user_func_array([$controller, $method], $params);
            return;
        }
    }

    error404();
}

function error404(): void
{
    http_response_code(404);
    view('errors/404', ['pageTitle' => 'Page non trouvée']);
    exit;
}

function error500(): void
{
    http_response_code(500);
    view('errors/500', ['pageTitle' => 'Erreur serveur']);
    exit;
}
