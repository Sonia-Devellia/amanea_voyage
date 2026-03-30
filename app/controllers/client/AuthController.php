<?php

// On déclare le namespace 
namespace App\Controllers\Client;

// On importe la classe parente et les Models dont on a besoin
use App\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;

// AuthController gère la connexion et la déconnexion des clients
// Les comptes sont créés par l'admin depuis le back-office
class AuthController extends Controller
{
    // Les Models utilisés dans ce Controller
    private User $userModel;
    private Notification $notificationModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->userModel         = new User();
        $this->notificationModel = new Notification();
    }

    // Affiche le formulaire de connexion
    public function login(): void
    {
        // Si le client est déjà connecté on le redirige vers son espace
        if (!empty($_SESSION['user'])) {
            $this->redirect('client/dashboard');
        }

        $this->render('client/login');
    }

    
    // Traite le formulaire de connexion
    public function authenticate(): void
    {
        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('client/login');
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

        // Si le compte n'existe pas ou le mot de passe est incorrect : message vague 
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
            'terms_accepted'   => $user['terms_accepted'],
            'last_activity'    => time(),
        ];

        // Si c'est la première connexion : changer le mot de passe
        if ($user['password_changed'] == 0) {
            $this->redirect('client/changePassword');
            return;
        }

        // Si les CGV et la charte n'ont pas encore été acceptées : page CGV et charte 
        if ($user['terms_accepted'] == 0) {
            $this->redirect('client/terms');
            return;
        }

        // Tout est bon : accès au dashboard
        $this->redirect('client/dashboard');
    }

    
    // Affiche le formulaire de changement de mp uniquement lors de la première connexion
    public function changePassword(): void
    {
        $this->requireAuth();

        $this->render('client/change_password');
    }

    // Traite le formulaire de changement de mp
    public function savePassword(): void
    {
        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('client/changePassword');
            return;
        }

        $this->requireAuth();

        $password        = trim($_POST['password']         ?? '');
        $passwordConfirm = trim($_POST['password_confirm'] ?? '');

        // Validation : les champs ne sont pas vides
        if (empty($password) || empty($passwordConfirm)) {
            $this->render('client/change_password', [
                'error' => 'Veuillez remplir tous les champs.',
            ]);
            return;
        }

        // Validation : le mp fait au moins 8 caractères avec majuscule, chiffre et caractère spécial
        if (strlen($password) < 8) {
            $this->render('client/change_password', [
                'error' => 'Le mot de passe doit contenir au moins 8 caractères.',
            ]);
            return;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $this->render('client/change_password', [
                'error' => 'Le mot de passe doit contenir au moins une lettre majuscule.',
            ]);
            return;
        }

        if (!preg_match('/[0-9]/', $password)) {
            $this->render('client/change_password', [
                'error' => 'Le mot de passe doit contenir au moins un chiffre.',
            ]);
            return;
        }

        if (!preg_match('/[\W_]/', $password)) {
            $this->render('client/change_password', [
                'error' => 'Le mot de passe doit contenir au moins un caractère spécial.',
            ]);
            return;
        }

        // Validation : les deux mp sont identiques
        if ($password !== $passwordConfirm) {
            $this->render('client/change_password', [
                'error' => 'Les mots de passe ne correspondent pas.',
            ]);
            return;
        }

        $id = $_SESSION['user']['id'];

        // On maj le mp en bdd
        $this->userModel->updatePassword($id, $password);

        // On marque le mp comme changé
        $this->userModel->markPasswordChanged($id);

        // On maj la session
        $_SESSION['user']['password_changed'] = 1;

        // On redirige vers la page CGV car c'est la prochaine étape
        $this->redirect('client/terms');
    }

    // -------------------------------------------------------------------------
    // Affiche la page CGV et Charte Amanéa
    // Le client doit lire et accepter les deux documents avant d'accéder au dashboard
    // -------------------------------------------------------------------------
    public function terms(): void
    {
        $this->requireAuth();

        // Si le client a déjà accepté les CGV on le redirige vers le dashboard
        if ($_SESSION['user']['terms_accepted'] == 1) {
            $this->redirect('client/dashboard');
            return;
        }

        $this->render('client/terms');
    }


    // Traite l'acceptation des CGV et de la Charte Amanéa
    public function acceptTerms(): void
    {
        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('client/terms');
            return;
        }

        $this->requireAuth();

        // On vérifie que les deux cases ont bien été cochées
        if (empty($_POST['accept_cgv']) || empty($_POST['accept_charte'])) {
            $this->render('client/terms', [
                'error' => 'Vous devez lire et accepter les deux documents pour continuer.',
            ]);
            return;
        }

        $id = $_SESSION['user']['id'];

        // On enregistre l'acceptation en base de données avec la date et l'heure
        $this->userModel->acceptTerms($id);

        // On maj la session
        $_SESSION['user']['terms_accepted'] = 1;

        // On crée une notification pour l'admin (Id_ADMIN = 1 car il n'y a qu'un seul admin)
        // La notification indique quel client a accepté et à quelle date
        $this->notificationModel->create([
            'type'     => 'terms_accepted',
            'message'  => $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . ' a lu et accepté les CGV et la Charte Amanéa.',
            'id_user'  => $_SESSION['user']['id'],
            'id_admin' => 1,
        ]);

        // On redirige vers le dashboard
        $this->redirect('client/dashboard');
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
