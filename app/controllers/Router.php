<?php

// On déclare le namespace 
namespace App\Controllers;

// Le Router lit l'URL et appelle le bon Controller et la bonne méthode
class Router
{
    // -------------------------------------------------------------------------
    // Liste de toutes les routes de l'application
    // Format : 'url' => ['Namespace\NomDuController', 'nomDeLaMethode']
    //
    // Chaque route est un tableau avec 2 cases :
    // case [0] = le nom complet du Controller (avec son namespace)
    // case [1] = la méthode à appeler dans ce Controller
    //
    // Exemple :
    // 'inspirations' => ['App\Controllers\ArticleController', 'index']
    //  → l'URL /inspirations appelle ArticleController → index()
    // -------------------------------------------------------------------------
    private array $routes = [

        // ---------------------------------------------------------------------
        // ESPACE PUBLIC
        // ---------------------------------------------------------------------

        // Page d'accueil
        'home'                  => ['App\Controllers\HomeController',               'index'],

        // L'Histoire d'Amanéa
        'a-propos'              => ['App\Controllers\AproposController',            'index'],

        // Voyages & Expériences — les 4 formules de voyage
        'voyages'               => ['App\Controllers\VoyagesController',            'index'],
        'voyages/groupe'        => ['App\Controllers\VoyagesController',            'groupe'],
        'voyages/feminin'       => ['App\Controllers\VoyagesController',            'feminin'],
        'voyages/noces'         => ['App\Controllers\VoyagesController',            'noces'],
        'voyages/personnalises' => ['App\Controllers\VoyagesController',            'personnalises'],

        // Inspirations & Conseils — articles
        'inspirations'          => ['App\Controllers\ArticleController',            'index'],
        'inspirations/show'     => ['App\Controllers\ArticleController',            'show'],
        'inspirations/category' => ['App\Controllers\ArticleController',            'category'],

        // Créons votre voyage — formulaire de contact
        'contact'               => ['App\Controllers\ContactController',            'index'],
        'contact/send'          => ['App\Controllers\ContactController',            'send'],

        // ---------------------------------------------------------------------
        // ESPACE CLIENT
        // ---------------------------------------------------------------------

        // Connexion / Déconnexion
        'client/connexion'      => ['App\Controllers\Client\AuthController',        'login'],
        'client/authenticate'   => ['App\Controllers\Client\AuthController',        'authenticate'],
        'client/changePassword' => ['App\Controllers\Client\AuthController',        'changePassword'],
        'client/savePassword'   => ['App\Controllers\Client\AuthController',        'savePassword'],
        'client/logout'         => ['App\Controllers\Client\AuthController',        'logout'],

        // Tableau de bord
        'client/dashboard'      => ['App\Controllers\Client\ClientController',      'index'],

        // Mon carnet de voyage
        'client/carnet'         => ['App\Controllers\Client\ClientController',      'notebook'],

        // Mes documents
        'client/documents'      => ['App\Controllers\Client\ClientController',      'documents'],

        // Mon profil
        'client/profil'         => ['App\Controllers\Client\ClientController',      'profile'],
        'client/updateProfile'  => ['App\Controllers\Client\ClientController',      'updateProfile'],

        // ---------------------------------------------------------------------
        // BACK-OFFICE ADMIN
        // ---------------------------------------------------------------------

        // Connexion / Déconnexion
        'admin'                 => ['App\Controllers\Admin\AdminAuthController',    'login'],
        'admin/authenticate'    => ['App\Controllers\Admin\AdminAuthController',    'authenticate'],
        'admin/logout'          => ['App\Controllers\Admin\AdminAuthController',    'logout'],

        // Tableau de bord admin
        'admin/dashboard'       => ['App\Controllers\Admin\AdminController',        'index'],
        'admin/stats' => ['App\Controllers\Admin\AdminController', 'stats'],

        // Gestion du blog
        'admin/blog'            => ['App\Controllers\Admin\AdminArticleController', 'index'],
        'admin/blog/new'        => ['App\Controllers\Admin\AdminArticleController', 'create'],
        'admin/blog/edit'       => ['App\Controllers\Admin\AdminArticleController', 'edit'],
        'admin/blog/delete'     => ['App\Controllers\Admin\AdminArticleController', 'delete'],
        'admin/blog/store'   => ['App\Controllers\Admin\AdminArticleController', 'store'],
        'admin/blog/update'  => ['App\Controllers\Admin\AdminArticleController', 'update'],
        'admin/blog/publish' => ['App\Controllers\Admin\AdminArticleController', 'publish'],
        'admin/blog/addMedia'    => ['App\Controllers\Admin\AdminArticleController', 'addMedia'],
        'admin/blog/removeMedia' => ['App\Controllers\Admin\AdminArticleController', 'removeMedia'],
        'admin/blog/updateCover' => ['App\Controllers\Admin\AdminArticleController', 'updateCover'],

        // Gestion du portfolio
        'admin/portfolio'       => ['App\Controllers\Admin\AdminMediaController',   'index'],
        'admin/portfolio/new'   => ['App\Controllers\Admin\AdminMediaController',   'create'],
        'admin/portfolio/edit'  => ['App\Controllers\Admin\AdminMediaController',   'edit'],
        'admin/portfolio/delete' => ['App\Controllers\Admin\AdminMediaController',   'delete'],

        // Gestion des clients
        'admin/clients'         => ['App\Controllers\Admin\AdminClientController',  'index'],
        'admin/clients/show'    => ['App\Controllers\Admin\AdminClientController',  'show'],
        'admin/clients/new'     => ['App\Controllers\Admin\AdminClientController',  'create'],
        'admin/clients/delete'  => ['App\Controllers\Admin\AdminClientController',  'delete'],

        // Gestion des projets de voyage
        'admin/projects'        => ['App\Controllers\Admin\AdminProjectController', 'index'],
        'admin/projects/show'   => ['App\Controllers\Admin\AdminProjectController', 'show'],
        'admin/projects/new'    => ['App\Controllers\Admin\AdminProjectController', 'create'],
        'admin/projects/edit'   => ['App\Controllers\Admin\AdminProjectController', 'edit'],
        'admin/projects/store'        => ['App\Controllers\Admin\AdminProjectController', 'store'],
        'admin/projects/update'       => ['App\Controllers\Admin\AdminProjectController', 'update'],
        'admin/projects/updateStatus' => ['App\Controllers\Admin\AdminProjectController', 'updateStatus'],

        // Gestion des messages
        'admin/messages'        => ['App\Controllers\Admin\AdminMessageController', 'index'],
        'admin/messages/show'   => ['App\Controllers\Admin\AdminMessageController', 'show'],

        // Gestion des notifications
        'admin/markNotificationRead'      => ['App\Controllers\Admin\AdminController', 'markNotificationRead'],
        'admin/markAllNotificationsRead'  => ['App\Controllers\Admin\AdminController', 'markAllNotificationsRead'],

        // Paramètres
        'admin/parametres'      => ['App\Controllers\Admin\AdminController',        'parametres'],
    ];

    // -------------------------------------------------------------------------
    // dispatch() est la méthode principale du Router
    // Elle est appelée une seule fois par index.php à chaque chargement de page
    // Elle lit l'URL, trouve la route correspondante,
    // et appelle la bonne méthode du bon Controller
    // -------------------------------------------------------------------------
    public function dispatch(): void
    {
        // ---------------------------------------------------------------------
        // ÉTAPE 1 : On récupère l'URL
        // Si l'URL est vide on affiche la page d'accueil
        // ---------------------------------------------------------------------
        $url = $_GET['url'] ?? 'home';

        // On supprime le slash final si présent 
        $url = rtrim($url, '/');

        // On nettoie l'URL pour supprimer les caractères dangereux
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // ---------------------------------------------------------------------
        // On sépare le paramètre du reste de l'URL
        // "inspirations/show/mon-slug" → route = "inspirations/show", paramètre = "mon-slug"
        // "inspirations"              → route = "inspirations",        paramètre = null
        // ---------------------------------------------------------------------
        $parts = explode('/', $url);
        $param = null;

        // Si l'URL a 3 parties, la dernière est un paramètre (slug ou id)
        if (count($parts) === 3) {
            $param = array_pop($parts);     // On récupère "mon-slug"
            $url   = implode('/', $parts);  // Il reste "inspirations/show"
        }

        // ---------------------------------------------------------------------
        //  On cherche la route correspondante dans notre liste
        // ---------------------------------------------------------------------
        if (!isset($this->routes[$url])) {
            $this->notFound();
            return;
        }

        // case [0] = le nom du Controller
        // case [1] = le nom de la méthode à appeler
        $controllerClass = $this->routes[$url][0];
        $method          = $this->routes[$url][1];

        // ---------------------------------------------------------------------
        //  On instancie le Controller et on appelle la méthode
        // ---------------------------------------------------------------------
        $instance = new $controllerClass();

        // On appelle la méthode avec ou sans paramètre selon l'URL
        if ($param !== null) {
            $instance->$method($param);
        } else {
            $instance->$method();
        }
    }

    // -------------------------------------------------------------------------
    // Affiche la page 404 si la route n'existe pas
    // -------------------------------------------------------------------------
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
