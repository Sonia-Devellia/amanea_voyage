<?php

// On déclare le namespace 
namespace App\Controllers\Client;

// On importe la classe parente et les Models
use App\Controllers\Controller;
use App\Models\User;
use App\Models\TravelProject;
use App\Models\Document;
use App\Models\Notebook;

// ClientController gère l'espace client connecté
class ClientController extends Controller
{
    // Les Models utilisés dans ce Controller
    private User $userModel;
    private TravelProject $travelProjectModel;
    private Document $documentModel;
    private Notebook $notebookModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->userModel          = new User();
        $this->travelProjectModel = new TravelProject();
        $this->documentModel      = new Document();
        $this->notebookModel      = new Notebook();
    }

    // -------------------------------------------------------------------------
    // Dashboard de l'espace client
    // Affiche un résumé des projets du client connecté
    // -------------------------------------------------------------------------
    public function index(): void
    {
        // On vérifie que le client est bien connecté
        $this->requireAuth();

        // On récupère l'id du client depuis la session
        $idUser = $_SESSION['user']['id'];

        // On récupère tous ses projets de voyage
        $projects = $this->travelProjectModel->findByUser($idUser);

        $this->render('client/dashboard', [
            'projects' => $projects,
        ]);
    }

    // Affiche le détail d'un projet de voyage
    public function project(int $id): void
    {
        // On vérifie que le client est bien connecté
        $this->requireAuth();

        // On récupère le projet par son id
        $project = $this->travelProjectModel->findById($id);

        // Si le projet n'existe pas on redirige vers le dashboard
        if (!$project) {
            $this->redirect('client');
            return;
        }

        // On vérifie que ce projet appartient bien au client connecté
        // Un client ne peut pas voir le projet d'un autre client
        if ($project['Id_USER'] !== $_SESSION['user']['id']) {
            $this->redirect('client');
            return;
        }

        // On récupère les documents liés à ce projet
        $documents = $this->documentModel->findByTravelProject($id);

        // On récupère le carnet de voyage lié à ce projet
        $notebook = $this->notebookModel->findByTravelProject($id);

        $this->render('client/project', [
            'project'   => $project,
            'documents' => $documents,
            'notebook'  => $notebook,
        ]);
    }

   
    // Affiche le profil du client connecté
    public function profile(): void
    {
        // On vérifie que le client est bien connecté
        $this->requireAuth();

        // On récupère les infos complètes du client depuis la BDD
        $user = $this->userModel->findById($_SESSION['user']['id']);

        $this->render('client/profile', [
            'user' => $user,
        ]);
    }

    
    // MAJ le profil du client connecté
    public function updateProfile(): void
    {
        // On vérifie que le client est bien connecté
        $this->requireAuth();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('client/profile');
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
            $this->render('client/profile', [
                'error' => 'Veuillez remplir tous les champs obligatoires.',
                'user'  => $data,
            ]);
            return;
        }

        // Validation du format de l'email
        if (!filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL)) {
            $this->render('client/profile', [
                'error' => 'L\'adresse email n\'est pas valide.',
                'user'  => $data,
            ]);
            return;
        }

        // On met à jour le profil en base de données
        $success = $this->userModel->update($_SESSION['user']['id'], $data);

        if ($success) {
            // On met à jour les infos en session
            $_SESSION['user']['firstname'] = $data['first_name'];
            $_SESSION['user']['lastname']  = $data['last_name'];
            $_SESSION['user']['email']     = $data['email'];

            $this->render('client/profile', [
                'success' => 'Votre profil a bien été mis à jour.',
                'user'    => $data,
            ]);
        } else {
            $this->render('client/profile', [
                'error' => 'Une erreur est survenue. Veuillez réessayer.',
                'user'  => $data,
            ]);
        }
    }
}