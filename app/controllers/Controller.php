<?php

// On déclare le namespace 
namespace App\Controllers;

// cette classe sert de base pour tous les Controllers
abstract class Controller
{
    
    // Charge une vue et lui transmet des données $data est un tableau de variables à rendre disponibles dans la vue
    protected function render(string $view, array $data = []): void
    {
        // extract() transforme chaque clé du tableau en variable
        extract($data);

        // On construit le chemin complet vers le fichier de vue
        $viewPath = APP_ROOT . '/app/views/' . $view . '.php';

        // Si le fichier de vue n'existe pas on affiche un message d'erreur clair
        if (!file_exists($viewPath)) {
            throw new \RuntimeException('Vue introuvable : ' . $view);
        }

        // On charge le fichier de vue
        require_once $viewPath;
    }

    
    // Redirige vers une autre page
    protected function redirect(string $url): void
    {
        header('Location: ' . APP_URL . '/' . $url);
        exit();
    }

    // -------------------------------------------------------------------------
    // Vérifie que le client est bien connecté
    // Si ce n'est pas le cas, il est redirigé vers la page de connexion
    // -------------------------------------------------------------------------
    protected function requireAuth(): void
    {
        if (empty($_SESSION['user'])) {
            $this->redirect('login');
        }
    }

    // -------------------------------------------------------------------------
    // Vérifie que l'admin est bien connecté
    // Si ce n'est pas le cas, il est redirigé vers la page de connexion admin
    // -------------------------------------------------------------------------
    protected function requireAdmin(): void
    {
        if (empty($_SESSION['admin'])) {
            $this->redirect('admin/login');
        }
    }
}