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


    // enregistre une route GET
    public function get(string $url, array $action): void
    {
        $this->routes['GET'][$url] = $action;
    }


    // enregistre une route POST
    public function post(string $url, array $action): void
    {
        $this->routes['POST'][$url] = $action;
    }


    // J'enregistre les 7 routes CRUD standard pour une entité en une seule ligne
    // Le paramètre $only me permet de limiter aux actions dont j'ai besoin
    public function resource(string $base, string $controller, array $only = []): void
    {
        // Je définis les 7 routes standard avec leur méthode HTTP, suffixe et action
        $standard = [
            ['GET',  '',               'index'],
            ['GET',  '/show/{id}',     'show'],
            ['GET',  '/new',           'create'],
            ['GET',  '/edit/{id}',     'edit'],
            ['POST', '/store',         'store'],
            ['POST', '/update/{id}',   'update'],
            ['POST', '/delete/{id}',   'delete'],
        ];

        // Je parcours les routes et je n'enregistre que celles présentes dans $only
        foreach ($standard as [$httpMethod, $suffix, $action]) {
            if (empty($only) || in_array($action, $only)) {
                $this->{strtolower($httpMethod)}($base . $suffix, [$controller, $action]);
            }
        }
    }


    // Je dispatch la requête vers le bon contrôleur et la bonne méthode
    public function dispatch(): void
    {
        // Je récupère l'URL, si elle est vide j'affiche la home
        $url = $_GET['url'] ?? 'home';

        // Je supprime le slash final s'il est présent
        $url = rtrim($url, '/');

        // Je nettoie l'URL pour supprimer les caractères dangereux
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Je récupère la méthode HTTP utilisée
        $method = $_SERVER['REQUEST_METHOD'];

        // Je récupère les routes enregistrées pour cette méthode HTTP
        $routes = $this->routes[$method] ?? [];

        // Passe 1 : je cherche une correspondance exacte sur les routes statiques
        if (isset($routes[$url])) {
            [$controllerClass, $action] = $routes[$url];
            (new $controllerClass())->$action();
            return;
        }

        // Passe 2 : je cherche une correspondance sur les routes avec {id} ou {slug}
        foreach ($routes as $pattern => $routeAction) {

            // J'ignore les routes sans placeholder
            if (!str_contains($pattern, '{')) {
                continue;
            }

            // Je découpe le pattern et l'URL en segments pour les comparer
            $patternParts = explode('/', $pattern);
            $urlParts     = explode('/', $url);

            // Si le nombre de segments est différent ce n'est pas la bonne route
            if (count($patternParts) !== count($urlParts)) {
                continue;
            }

            $id    = null;
            $slug  = null;
            $match = true;

            foreach ($patternParts as $i => $segment) {
                if ($segment === '{id}') {
                    // Je caste en int pour conserver le typage dans les contrôleurs
                    $id = (int) $urlParts[$i];
                } elseif ($segment === '{slug}') {
                    // Je passe le slug tel quel en string
                    $slug = $urlParts[$i];
                } elseif ($segment !== $urlParts[$i]) {
                    $match = false;
                    break;
                }
            }

            // J'appelle la méthode du contrôleur avec le bon paramètre
            if ($match) {
                [$controllerClass, $action] = $routeAction;
                $instance = new $controllerClass();
                if ($id !== null) {
                    $instance->$action($id);
                } else {
                    $instance->$action($slug);
                }
                return;
            }
        }

        // Aucune route trouvée, j'affiche la page 404
        $this->notFound();
    }


    // J'affiche la page 404 si la route n'existe pas
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
