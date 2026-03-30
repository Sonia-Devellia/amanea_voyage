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
    // Vérifie que le client est bien connecté, sinon il est redirigé vers la page de connexion
    // Déconnecte automatiquement le client après 30 minutes d'inactivité (timeout)
    // -------------------------------------------------------------------------
    private const USER_SESSION_TIMEOUT = 30 * 60;

    protected function requireAuth(): void
    {
        if (empty($_SESSION['user'])) {
            $this->redirect('client/login');
            return;
        }

        if (isset($_SESSION['user']['last_activity'])
            && (time() - $_SESSION['user']['last_activity']) > self::USER_SESSION_TIMEOUT
        ) {
            unset($_SESSION['user']);
            $this->redirect('client/login?timeout=1');
            return;
        }

        $_SESSION['user']['last_activity'] = time();
    }

    // -------------------------------------------------------------------------
    // Vérifie que l'admin est bien connecté, sinon il est redirigé vers la page de connexion admin
    // Déconnecte automatiquement l'admin après 30 minutes d'inactivité (timeout)
    // -------------------------------------------------------------------------
    private const ADMIN_SESSION_TIMEOUT = 30 * 60;

    protected function requireAdmin(): void
    {
        if (empty($_SESSION['admin'])) {
            $this->redirect('admin');
            return;
        }

        if (isset($_SESSION['admin']['last_activity'])
            && (time() - $_SESSION['admin']['last_activity']) > self::ADMIN_SESSION_TIMEOUT
        ) {
            unset($_SESSION['admin']);
            $this->redirect('admin?timeout=1');
            return;
        }

        $_SESSION['admin']['last_activity'] = time();
    }
}