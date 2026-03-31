<?php

// On déclare le namespace
namespace App\Controllers;

// Le Router reçoit les routes enregistrées et dispatch les requêtes
class Router
{
    // Stocke toutes les routes enregistrées séparées par méthode HTTP
    private array $routes = [
        'GET'  => [],
        'POST' => [],
    ];


    // Enregistre une route GET
    public function get(string $url, array $action): void
    {
        $this->routes['GET'][$url] = $action;
    }


    // Enregistre une route POST
    public function post(string $url, array $action): void
    {
        $this->routes['POST'][$url] = $action;
    }


    // Enregistre les 7 routes CRUD standard pour une entité en une seule ligne
    // Le paramètre $only permet de limiter aux actions dont on a besoin
    public function resource(string $base, string $controller, array $only = []): void
    {
        $standard = [
            ['GET',  '',               'index'],
            ['GET',  '/show/{id}',     'show'],
            ['GET',  '/new',           'create'],
            ['GET',  '/edit/{id}',     'edit'],
            ['POST', '/store',         'store'],
            ['POST', '/update/{id}',   'update'],
            ['POST', '/delete/{id}',   'delete'],
        ];

        foreach ($standard as [$httpMethod, $suffix, $action]) {
            if (empty($only) || in_array($action, $only)) {
                $this->{strtolower($httpMethod)}($base . $suffix, [$controller, $action]);
            }
        }
    }


    // Dispatche la requête vers le bon contrôleur et la bonne méthode
    public function dispatch(): void
    {
        $url    = filter_var(rtrim($_GET['url'] ?? 'home', '/'), FILTER_SANITIZE_URL);
        $method = $_SERVER['REQUEST_METHOD'];
        $routes = $this->routes[$method] ?? [];

        // Passe 1 : correspondance exacte sur les routes statiques
        if (isset($routes[$url])) {
            $this->call($routes[$url]);
            return;
        }

        // Passe 2 : routes avec paramètres {id} ou {slug}
        foreach ($routes as $pattern => $routeAction) {
            $params = $this->match($pattern, $url);
            if ($params !== null) {
                $this->call($routeAction, ...$params);
                return;
            }
        }

        $this->notFound();
    }


    // Vérifie si un pattern correspond à l'URL et retourne les paramètres capturés
    // Retourne null si aucune correspondance
    private function match(string $pattern, string $url): ?array
    {
        if (!str_contains($pattern, '{')) {
            return null;
        }

        $patternParts = explode('/', $pattern);
        $urlParts     = explode('/', $url);

        if (count($patternParts) !== count($urlParts)) {
            return null;
        }

        $params = [];

        foreach ($patternParts as $i => $segment) {
            if ($segment === '{id}') {
                $params[] = (int) $urlParts[$i];
            } elseif ($segment === '{slug}') {
                $params[] = $urlParts[$i];
            } elseif ($segment !== $urlParts[$i]) {
                return null;
            }
        }

        return $params;
    }


    // Instancie le contrôleur et appelle la méthode avec les paramètres
    private function call(array $routeAction, mixed ...$params): void
    {
        [$controllerClass, $action] = $routeAction;
        (new $controllerClass())->$action(...$params);
    }


    // Affiche la page 404 si aucune route ne correspond
    private function notFound(): void
    {
        http_response_code(404);
        $chemin = APP_ROOT . '/app/views/public/404.php';

        if (file_exists($chemin)) {
            require_once $chemin;
        } else {
            echo '404 - Page non trouvée';
        }
    }
}
