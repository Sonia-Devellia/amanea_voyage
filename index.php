<?php

// On démarre la session PHP
session_start();

// On définit le chemin racine du projet
// __DIR__ retourne le dossier où se trouve ce fichier
define('APP_ROOT', __DIR__);

// On charge l'autoload de Composer
// Il gère automatiquement tous les namespaces déclarés dans composer.json
// Plus besoin de faire des require_once pour chaque classe
require_once APP_ROOT . '/vendor/autoload.php';

// On charge le fichier de configuration il lit le .env et crée toutes les constantes (DB_HOST, APP_URL...)
require_once APP_ROOT . '/config/config.php';

// On démarre le routeur il lit l'URL et appelle le bon Controller et la bonne méthode
$router = new App\Controllers\Router();
$router->dispatch();