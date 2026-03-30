<?php

// On déclare le namespace
namespace App\Controllers;

// Le Router reçoit les routes enregistrées et dispatch les requêtes
class Router
{
    // Stocke toutes les routes enregistrées
    // Séparées par méthode HTTP : GET et POST
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

    // -------------------------------------------------------------------------
    // resource() enregistre les routes CRUD standard pour une entité
    // Chaque entité (clients, projets, blog...) obtient ses routes en une ligne
    //
    // Routes générées pour resource('admin/clients', AdminClientController::class) :
    //   GET  admin/clients               → index()
    //   GET  admin/clients/show/{id}     → show(int $id)
    //   GET  admin/clients/new           → create()
    //   GET  admin/clients/edit/{id}     → edit(int $id)
    //   POST admin/clients/store         → store()
    //   POST admin/clients/update/{id}   → update(int $id)
    //   POST admin/clients/delete/{id}   → delete(int $id)
    //
    // Le paramètre $only permet de limiter aux actions utiles pour l'entité
    // Exemple : resource('admin/messages', ..., ['index', 'show', 'delete'])
    // -------------------------------------------------------------------------
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

    // -------------------------------------------------------------------------
    // dispatch() est la méthode principale du Router
    // Elle est appelée une seule fois par index.php à chaque chargement de page
    //
    // Deux passes de matching :
    //   1. Exact  — routes statiques sans paramètre  ex: admin/clients
    //   2. Pattern — routes avec {id}               ex: admin/clients/show/{id}
    //      → {id} est converti en regex (\d+)
    //      → la valeur capturée est castée en int et passée à la méthode
    //         ce qui permet de garder le typage (int $id) dans les contrôleurs
    // -------------------------------------------------------------------------
    public function dispatch(): void
    {
        // récupère l'URL, si vide on affiche la home
        $url = $_GET['url'] ?? 'home';

        // supprime le slash final si présent
        $url = rtrim($url, '/');

        // nettoie l'URL pour supprimer les caractères dangereux
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // récupère la méthode HTTP utilisée (GET ou POST)
        $method = $_SERVER['REQUEST_METHOD'];

        // récupère les routes enregistrées pour cette méthode HTTP
        $routes = $this->routes[$method] ?? [];

        // --- Passe 1 : matching exact (routes sans paramètre) ---
        if (isset($routes[$url])) {
            [$controllerClass, $action] = $routes[$url];
            (new $controllerClass())->$action();
            return;
        }

        // --- Passe 2 : matching par segments (routes avec {id} ou {slug}) ---
        foreach ($routes as $pattern => $routeAction) {
            // on ignore les routes sans placeholder
            if (!str_contains($pattern, '{')) {
                continue;
            }

            $patternParts = explode('/', $pattern);
            $urlParts     = explode('/', $url);

            // le nombre de segments doit être identique
            if (count($patternParts) !== count($urlParts)) {
                continue;
            }

            $id    = null;
            $slug  = null;
            $match = true;

            foreach ($patternParts as $i => $segment) {
                if ($segment === '{id}') {
                    // {id} : segment numérique, casté en int pour conserver le typage
                    $id = (int) $urlParts[$i];
                } elseif ($segment === '{slug}') {
                    // {slug} : segment texte, passé tel quel en string
                    $slug = $urlParts[$i];
                } elseif ($segment !== $urlParts[$i]) {
                    $match = false;
                    break;
                }
            }

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

        // aucune route trouvée : 404
        $this->notFound();
    }


    // Affiche la page 404 si la route n'existe pas
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
