<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// On démarre la session PHP
session_start();

// On définit le chemin racine du projet
define('APP_ROOT', __DIR__);

// On charge la config
// Elle lit le .env et crée toutes les constantes (DB_HOST, APP_URL...)
require_once APP_ROOT . '/config/config.php';

// On charge l'autoload de Composer
// Il gère automatiquement tous les namespaces déclarés dans composer.json
require_once APP_ROOT . '/vendor/autoload.php';

// On instancie le Router
$router = new App\Controllers\Router();

// On charge le fichier de routes
// Toutes les routes GET et POST y sont déclarées
require_once APP_ROOT . '/routes.php';

// On démarre le Router i lit l'URL et appelle le bon Controller et la bonne méthode
$router->dispatch();