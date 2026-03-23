<?php

// Chargement de l'autoload Composer (inclut phpdotenv)
require_once APP_ROOT . '/vendor/autoload.php';

// Chargement du fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(APP_ROOT);
$dotenv->load();

// Validation des variables obligatoires
$dotenv->required([
    'APP_NAME',
    'APP_URL',
    'DB_HOST',
    'DB_NAME',
    'DB_USER',
    'DB_CHARSET',
]);

// Constantes de l'application (accessibles partout)
define('APP_NAME',    $_ENV['APP_NAME']);
define('APP_URL',     $_ENV['APP_URL']);
define('APP_ENV',     $_ENV['APP_ENV']   ?? 'production');
define('APP_DEBUG',   $_ENV['APP_DEBUG'] === 'true');

define('DB_HOST',    $_ENV['DB_HOST']);
define('DB_NAME',    $_ENV['DB_NAME']);
define('DB_USER',    $_ENV['DB_USER']);
define('DB_PASS',    $_ENV['DB_PASS']    ?? '');
define('DB_CHARSET', $_ENV['DB_CHARSET']);

define('PEXELS_API_KEY', $_ENV['PEXELS_API_KEY'] ?? '');
