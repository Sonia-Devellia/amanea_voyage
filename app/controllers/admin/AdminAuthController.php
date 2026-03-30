<?php

// On déclare le namespace 
namespace App\Controllers\Admin;

// On importe la classe parente et le Model dont on a besoin
use App\Controllers\Controller;
use App\Models\Admin;

// AdminAuthController gère la connexion et la déconnexion de l'admin (Nora)
class AdminAuthController extends Controller
{
    // Le Model utilisé dans ce Controller
    private Admin $adminModel;

    // Le constructeur instancie le Model dont on a besoin
    public function __construct()
    {
        $this->adminModel = new Admin();
    }

 
    // Affiche le formulaire de connexion admin
    public function login(): void
    {
        // Si l'admin est déjà connecté ->redirige vers le dashboard
        if (!empty($_SESSION['admin'])) {
            $this->redirect('admin/dashboard');
        }

        $this->render('admin/login');
    }

  
    // Traite le formulaire de connexion admin
    public function authenticate(): void
    {
        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin');
            return;
        }

        // On récupère et nettoie les données du formulaire
        $email    = htmlspecialchars(trim($_POST['email']    ?? ''));
        $password = trim($_POST['password']                  ?? '');

        // Validation des champs obligatoires
        if (empty($email) || empty($password)) {
            $this->render('admin/login', [
                'error' => 'Veuillez remplir tous les champs.',
            ]);
            return;
        }

        // Validation du format de l'email
        if (!filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL)) {
            $this->render('admin/login', [
                'error' => 'L\'adresse email n\'est pas valide.',
            ]);
            return;
        }

        // On cherche le compte admin par email en bdd
        $admin = $this->adminModel->findByEmail($email);

        // Si le compte n'existe pas ou le mp est incorrect
        if (!$admin || !$this->adminModel->verifyPassword($password, $admin['password'])) {
            $this->render('admin/login', [
                'error' => 'Email ou mot de passe incorrect.',
            ]);
            return;
        }

        // Connexion réussie : on stocke les infos de l'admin en session
        // On ne stocke jamais le mp en session
        $_SESSION['admin'] = [
            'id'            => $admin['Id_ADMIN'],
            'email'         => $admin['email'],
            'last_activity' => time(),
        ];

        // On enregistre la date de dernière connexion
        $this->adminModel->updateLastLogin($admin['Id_ADMIN']);

        // On redirige vers le dashboard admin
        $this->redirect('admin/dashboard');
    }

    // Déconnecte l'admin
    public function logout(): void
    {
        // On supprime les données de l'admin en session
        unset($_SESSION['admin']);

        // On redirige vers la page de connexion admin
        $this->redirect('admin');
    }
}