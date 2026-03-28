<?php

// On déclare le namespace 
namespace App\Controllers\Admin;

// On importe la classe parente et les Models dont on a besoin
use App\Controllers\Controller;
use App\Models\User;
use App\Models\TravelProject;

// AdminClientController gère les clients depuis le back-office
// C'est Nora qui crée les comptes clients et leur assigne leurs accès
class AdminClientController extends Controller
{
    // Les Models utilisés dans ce Controller
    private User $userModel;
    private TravelProject $travelProjectModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->userModel          = new User();
        $this->travelProjectModel = new TravelProject();
    }


    // Liste tous les clients
    public function index(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère tous les clients
        $clients = $this->userModel->findAll();

        $this->render('admin/clients/index', [
            'clients' => $clients,
        ]);
    }

    
    // Affiche la fiche d'un client
    public function show(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère le client
        $client = $this->userModel->findById($id);

        // Si le client n'existe pas on redirige vers la liste
        if (!$client) {
            $this->redirect('admin/clients');
            return;
        }

        // On récupère les projets de voyage de ce client
        $projects = $this->travelProjectModel->findByUser($id);

        $this->render('admin/clients/show', [
            'client'   => $client,
            'projects' => $projects,
        ]);
    }

    // -------------------------------------------------------------------------
    // Affiche le formulaire de création d'un client
    // Nora crée le compte client avec un mot de passe temporaire généré automatiquement
    // -------------------------------------------------------------------------
    public function create(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->render('admin/clients/create');
    }

  
    // Enregistre le nouveau client en base de données
    public function store(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/clients/new');
            return;
        }

        // On récupère et nettoie les données du formulaire
        $data = [
            'last_name'  => htmlspecialchars(trim($_POST['last_name']  ?? '')),
            'first_name' => htmlspecialchars(trim($_POST['first_name'] ?? '')),
            'email'      => htmlspecialchars(trim($_POST['email']      ?? '')),
            'phone'      => htmlspecialchars(trim($_POST['phone']      ?? '')),
        ];

        // Validation des champs obligatoires
        if (empty($data['last_name']) || empty($data['first_name']) || empty($data['email'])) {
            $this->render('admin/clients/create', [
                'error' => 'Veuillez remplir tous les champs obligatoires.',
                'data'  => $data,
            ]);
            return;
        }

        // Validation du format de l'email
        if (!filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL)) {
            $this->render('admin/clients/create', [
                'error' => 'L\'adresse email n\'est pas valide.',
                'data'  => $data,
            ]);
            return;
        }

        // On vérifie que l'email n'est pas déjà utilisé
        if ($this->userModel->findByEmail($data['email'])) {
            $this->render('admin/clients/create', [
                'error' => 'Cette adresse email est déjà utilisée.',
                'data'  => $data,
            ]);
            return;
        }

        // On génère un mp temporaire aléatoire de 10 caractères
        // Le client devra le changer à sa première connexion
        $temporaryPassword   = bin2hex(random_bytes(5));
        $data['password']    = $temporaryPassword;

        // On crée le compte client en base de données
        $success = $this->userModel->create($data);

        if ($success) {
            // On affiche la confirmation avec le mot de passe temporaire
            // Nora devra le communiquer au client par email ou téléphone
            $this->render('admin/clients/create', [
                'success'           => 'Le compte client a bien été créé.',
                'temporaryPassword' => $temporaryPassword,
                'clientName'        => $data['first_name'] . ' ' . $data['last_name'],
            ]);
        } else {
            $this->render('admin/clients/create', [
                'error' => 'Une erreur est survenue. Veuillez réessayer.',
                'data'  => $data,
            ]);
        }
    }

   
    // Supprime un client
    public function delete(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->userModel->delete($id);
        $this->redirect('admin/clients');
    }
}