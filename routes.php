<?php

// ============================================================
// Fichier de routes de Amanéa Voyage
// GET  → affiche une page
// POST → traite un formulaire ou une action sensible (écriture, suppression)
//
// Les entités admin utilisent resource() qui génère automatiquement
// les 7 routes CRUD standard. Les routes avec ID utilisent le
// placeholder {id} — le router extrait la valeur et la passe
// directement en (int $id) au contrôleur, ce qui conserve le typage.
// ============================================================

use App\Controllers\ApiController;
use App\Controllers\HomeController;
use App\Controllers\AproposController;
use App\Controllers\VoyagesController;
use App\Controllers\TypeController;
use App\Controllers\ArticleController;
use App\Controllers\ContactController;
use App\Controllers\Client\AuthController;
use App\Controllers\Client\ClientController;
use App\Controllers\Admin\AdminAuthController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\AdminArticleController;
use App\Controllers\Admin\AdminMediaController;
use App\Controllers\Admin\AdminClientController;
use App\Controllers\Admin\AdminProjectController;
use App\Controllers\Admin\AdminMessageController;
use App\Controllers\Admin\AdminDestinationController;
use App\Controllers\Admin\AdminTravelController;

// ---------------------------------------------------------------------
// API JSON — endpoints consommés par le frontend
// ---------------------------------------------------------------------

$router->get('api/pexels-photo', [ApiController::class, 'pexelsPhoto']);

// ---------------------------------------------------------------------
// ESPACE PUBLIC
// ---------------------------------------------------------------------

$router->get('home',                  [HomeController::class,    'index']);
$router->get('a-propos',              [AproposController::class, 'index']);

// Formules de voyage
$router->get('formules',                   [TypeController::class,    'index']);
$router->get('formules/show/{slug}',       [TypeController::class,    'show']);

// Voyages & Expériences
$router->get('voyages',               [VoyagesController::class, 'index']);
$router->get('voyages/groupe',        [VoyagesController::class, 'groupe']);
$router->get('voyages/feminin',       [VoyagesController::class, 'feminin']);
$router->get('voyages/noces',         [VoyagesController::class, 'noces']);
$router->get('voyages/personnalises', [VoyagesController::class, 'personnalises']);

// Inspirations & Conseils
$router->get('inspirations',                    [ArticleController::class, 'index']);
$router->get('inspirations/show/{slug}',        [ArticleController::class, 'show']);
$router->get('inspirations/category/{slug}',    [ArticleController::class, 'category']);

// Créons votre voyage — contact
$router->get('contact',               [ContactController::class, 'index']);
$router->post('contact/send',         [ContactController::class, 'send']);

// ---------------------------------------------------------------------
// ESPACE CLIENT
// ---------------------------------------------------------------------

$router->get('client/login',          [AuthController::class,   'login']);
$router->get('client/changePassword', [AuthController::class,   'changePassword']);
$router->get('client/terms',          [AuthController::class,   'terms']);
$router->post('client/logout',        [AuthController::class,   'logout']);
$router->get('client/dashboard',      [ClientController::class, 'index']);
$router->get('client/projet/{id}',    [ClientController::class, 'project']);
$router->get('client/carnet',         [ClientController::class, 'notebook']);
$router->get('client/documents',      [ClientController::class, 'documents']);
$router->get('client/profil',         [ClientController::class, 'profile']);
$router->post('client/authenticate',  [AuthController::class,   'authenticate']);
$router->post('client/savePassword',  [AuthController::class,   'savePassword']);
$router->post('client/acceptTerms',   [AuthController::class,   'acceptTerms']);
$router->post('client/updateProfile', [ClientController::class, 'updateProfile']);

// ---------------------------------------------------------------------
// BACK-OFFICE ADMIN — authentification et dashboard
// ---------------------------------------------------------------------

$router->get('admin',                              [AdminAuthController::class, 'login']);
$router->post('admin/authenticate',               [AdminAuthController::class, 'authenticate']);
$router->post('admin/logout',                     [AdminAuthController::class, 'logout']);
$router->get('admin/dashboard',                   [AdminController::class,     'index']);
$router->get('admin/stats',                       [AdminController::class,     'stats']);
$router->get('admin/parametres',                  [AdminController::class,     'parametres']);
$router->post('admin/markNotificationRead/{id}',  [AdminController::class,     'markNotificationRead']);
$router->post('admin/markAllNotificationsRead',   [AdminController::class,     'markAllNotificationsRead']);

// ---------------------------------------------------------------------
// BACK-OFFICE ADMIN — entités CRUD
// resource() génère les 7 routes standard avec typage {id} préservé
// ---------------------------------------------------------------------

// Blog : sans show (l'admin passe directement par edit) + 4 routes spécifiques aux médias de l'article
$router->resource('admin/blog', AdminArticleController::class, ['index', 'create', 'store', 'edit', 'update', 'delete']);
$router->post('admin/blog/publish/{id}',     [AdminArticleController::class, 'publish']);
$router->post('admin/blog/addMedia/{id}',    [AdminArticleController::class, 'addMedia']);
$router->post('admin/blog/removeMedia/{id}', [AdminArticleController::class, 'removeMedia']);
$router->post('admin/blog/updateCover/{id}', [AdminArticleController::class, 'updateCover']);

// Portfolio médias : sans show (l'admin passe directement par edit)
$router->resource('admin/portfolio', AdminMediaController::class, ['index', 'create', 'store', 'edit', 'update', 'delete']);

// Clients : 7 routes standard
$router->resource('admin/clients', AdminClientController::class);

// Projets de voyage : 7 routes standard + updateStatus
$router->resource('admin/projects', AdminProjectController::class);
$router->post('admin/projects/updateStatus/{id}', [AdminProjectController::class, 'updateStatus']);

// Messages : lecture et suppression seulement (pas de create/edit/store/update)
$router->resource('admin/messages', AdminMessageController::class, ['index', 'show', 'delete']);
$router->post('admin/messages/markAnswered/{id}', [AdminMessageController::class, 'markAnswered']);

// Destinations : CRUD complet (page Voyages)
$router->resource('admin/destinations', AdminDestinationController::class, ['index', 'create', 'store', 'edit', 'update', 'delete']);

// Catalogue voyages : CRUD complet (itinéraires avec prix)
$router->resource('admin/travels', AdminTravelController::class, ['index', 'create', 'store', 'edit', 'update', 'delete']);
