<?php

// On déclare le namespace : AuthController fait partie des Controllers Client
namespace App\Controllers\Client;

// On importe la classe parente et le Model dont on a besoin
use App\Controllers\Controller;
use App\Models\User;

// AuthController gère la connexion et la déconnexion des clients
// Les comptes sont créés par l'admin depuis le back-office
class AuthController extends Controller
{
    // Le Model utilisé dans ce Controller
    private User $userModel;

    // Le constructeur instancie le Model dont on a besoin
    public function __construct()
    {
        $this->userModel = new User();
    }

   
    // Affiche le formulaire de connexion
    public function login(): void
    {
        // Si le client est déjà connecté on le redirige vers son espace
        if (!empty($_SESSION['user'])) {
            $this->redirect('client');
        }

        $this->render('client/login');
    }

   
    // Traite le formulaire de connexion
   public function authenticate(): void
    {
        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('login');
            return;
        }

        // On récupère et nettoie les données du formulaire
        $email    = htmlspecialchars(trim($_POST['email']    ?? ''));
        $password = trim($_POST['password']                  ?? '');

        // Validation des champs obligatoires
        if (empty($email) || empty($password)) {
            $this->render('client/login', [
                'error' => 'Veuillez remplir tous les champs.',
            ]);
            return;
        }

        // Validation du format de l'email
        if (!filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL)) {
            $this->render('client/login', [
                'error' => 'L\'adresse email n\'est pas valide.',
            ]);
            return;
        }

        // On cherche le compte par email en base de données
        $user = $this->userModel->findByEmail($email);

        // Si le compte n'existe pas ou le mot de passe est incorrect
        // Message volontairement vague pour ne pas donner d'indices à un attaquant
        if (!$user || !$this->userModel->verifyPassword($password, $user['password'])) {
            $this->render('client/login', [
                'error' => 'Email ou mot de passe incorrect.',
            ]);
            return;
        }

        // Connexion réussie : on stocke les infos du client en session
        // On ne stocke jamais le mot de passe en session
        $_SESSION['user'] = [
            'id'               => $user['Id_USER'],
            'firstname'        => $user['first_name'],
            'lastname'         => $user['last_name'],
            'email'            => $user['email'],
            'password_changed' => $user['password_changed'],
        ];

        // Si c'est la première connexion (password_changed = 0)
        // On force le client à changer son mot de passe temporaire
        if ($user['password_changed'] == 0) {
            $this->redirect('login/changePassword');
            return;
        }

        // Sinon on redirige vers l'espace client
        $this->redirect('client');
    }

  
    // Affiche le formulaire de changement de mot de passeniquement accessible si le client vient de se connecter
 
    public function changePassword(): void
    {
        // On vérifie que le client est bien connecté
        if (empty($_SESSION['user'])) {
            $this->redirect('login');
            return;
        }

        $this->render('client/change_password');
    }

 
    // Traite le formulaire de changement de mot de passe
    public function savePassword(): void
    {
        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('login/changePassword');
            return;
        }

        // On vérifie que le client est bien connecté
        if (empty($_SESSION['user'])) {
            $this->redirect('login');
            return;
        }

        $password        = trim($_POST['password']         ?? '');
        $passwordConfirm = trim($_POST['password_confirm'] ?? '');

        // Validation : les champs ne sont pas vides
        if (empty($password) || empty($passwordConfirm)) {
            $this->render('client/change_password', [
                'error' => 'Veuillez remplir tous les champs.',
            ]);
            return;
        }

        // Validation : le mot de passe fait au moins 8 caractères
        if (strlen($password) < 8) {
            $this->render('client/change_password', [
                'error' => 'Le mot de passe doit contenir au moins 8 caractères.',
            ]);
            return;
        }

        // Validation : les deux mots de passe sont identiques
        if ($password !== $passwordConfirm) {
            $this->render('client/change_password', [
                'error' => 'Les mots de passe ne correspondent pas.',
            ]);
            return;
        }

        // On met à jour le mot de passe en base de données
        $id = $_SESSION['user']['id'];
        $this->userModel->updatePassword($id, $password);

        // On marque le mot de passe comme changé en base de données
        $this->userModel->markPasswordChanged($id);

        // On met à jour la session
        $_SESSION['user']['password_changed'] = 1;

        // On redirige vers l'espace client
        $this->redirect('client');
    }

   
    // Déconnecte le client
    public function logout(): void
    {
        // On supprime les données du client en session
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil
        $this->redirect('home');
    }
}