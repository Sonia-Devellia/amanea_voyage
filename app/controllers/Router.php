<?php

namespace App\Controllers;

class Router
{
    public function dispatch(): void
    {
        $url = $_GET['url'] ?? 'home';
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);

        $parts      = explode('/', $url);
        $controller = ucfirst($parts[0] ?? 'Home') . 'Controller';
        $method     = $parts[1] ?? 'index';
        $param      = $parts[2] ?? null;

        // Cherche le controller dans admin/ puis client/
        $namespacedController = null;
        $paths = [
            'App\\Controllers\\Admin\\'  . $controller =>
                APP_ROOT . '/app/controllers/admin/'  . $controller . '.php',
            'App\\Controllers\\Client\\' . $controller =>
                APP_ROOT . '/app/controllers/client/' . $controller . '.php',
        ];

        foreach ($paths as $namespace => $path) {
            if (file_exists($path)) {
                require_once $path;
                $namespacedController = $namespace;
                break;
            }
        }

        if ($namespacedController === null) {
            $this->notFound();
            return;
        }

        $instance = new $namespacedController();

        if (!method_exists($instance, $method)) {
            $this->notFound();
            return;
        }

        $param !== null
            ? $instance->$method($param)
            : $instance->$method();
    }

    private function notFound(): void
    {
        http_response_code(404);
        $path = APP_ROOT . '/app/views/public/404.php';
        if (file_exists($path)) require_once $path;
        else echo '404 - Page non trouvée';
    }
}
