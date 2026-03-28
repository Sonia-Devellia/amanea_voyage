<?php

// On déclare le namespace 
namespace App\Controllers\Admin;

// On importe la classe parente et les Models dont on a besoin
use App\Controllers\Controller;
use App\Models\TravelProject;
use App\Models\User;
use App\Models\Document;
use App\Models\Notebook;

// AdminProjectController gère les projets de voyage des clients
// C'est Nora qui crée et met à jour les projets depuis le back-office
class AdminProjectController extends Controller
{
    // Les Models utilisés dans ce Controller
    private TravelProject $travelProjectModel;
    private User $userModel;
    private Document $documentModel;
    private Notebook $notebookModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->travelProjectModel = new TravelProject();
        $this->userModel          = new User();
        $this->documentModel      = new Document();
        $this->notebookModel      = new Notebook();
    }


    // Liste tous les projets de voyage
    public function index(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère tous les projets
        $projects = $this->travelProjectModel->findAll();

        $this->render('admin/projects/index', [
            'projects' => $projects,
        ]);
    }


    // Affiche le détail d'un projet de voyage
    public function show(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère le projet
        $project = $this->travelProjectModel->findById($id);

        // Si le projet n'existe pas on redirige vers la liste
        if (!$project) {
            $this->redirect('admin/projects');
            return;
        }

        // On récupère le client associé au projet
        $client = $this->userModel->findById($project['Id_USER']);

        // On récupère les documents liés au projet
        $documents = $this->documentModel->findByTravelProject($id);

        // On récupère le carnet de voyage lié au projet
        $notebook = $this->notebookModel->findByTravelProject($id);

        $this->render('admin/projects/show', [
            'project'   => $project,
            'client'    => $client,
            'documents' => $documents,
            'notebook'  => $notebook,
        ]);
    }

    // -------------------------------------------------------------------------
    // Affiche le formulaire de création d'un projet
    // C'est Nora qui crée le projet pour le client
    // -------------------------------------------------------------------------
    public function create(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère la liste des clients pour la liste déroulante
        $clients = $this->userModel->findAll();

        $this->render('admin/projects/create', [
            'clients' => $clients,
        ]);
    }


    // Enregistre le nouveau projet en bdd
    public function store(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/projects/new');
            return;
        }

        // On récupère et nettoie les données du formulaire
        $data = [
            'title'       => htmlspecialchars(trim($_POST['title']       ?? '')),
            'destination' => htmlspecialchars(trim($_POST['destination'] ?? '')),
            'start_date'  => trim($_POST['start_date']                   ?? ''),
            'end_date'    => trim($_POST['end_date']                     ?? ''),
            'budget'      => trim($_POST['budget']                       ?? ''),
            'notes'       => htmlspecialchars(trim($_POST['notes']       ?? '')),
            'id_user'     => (int) ($_POST['id_user']                    ?? 0),
        ];

        // Validation des champs obligatoires
        if (empty($data['title']) || empty($data['destination']) || empty($data['id_user'])) {
            $this->render('admin/projects/create', [
                'error'   => 'Veuillez remplir tous les champs obligatoires.',
                'data'    => $data,
                'clients' => $this->userModel->findAll(),
            ]);
            return;
        }

        // On crée le projet en bdd
        // Le statut est automatiquement mis à 'en_attente' dans le Model
        $success = $this->travelProjectModel->create($data);

        if ($success) {
            $this->redirect('admin/projects');
        } else {
            $this->render('admin/projects/create', [
                'error'   => 'Une erreur est survenue. Veuillez réessayer.',
                'data'    => $data,
                'clients' => $this->userModel->findAll(),
            ]);
        }
    }


    // Affiche le formulaire de modification d'un projet
    public function edit(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère le projet à modifier
        $project = $this->travelProjectModel->findById($id);

        // Si le projet n'existe pas on redirige vers la liste
        if (!$project) {
            $this->redirect('admin/projects');
            return;
        }

        $this->render('admin/projects/edit', [
            'project' => $project,
        ]);
    }

   
    // Enregistre les modifications d'un projet en bdd
    public function update(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/projects/edit/' . $id);
            return;
        }

        // On récupère et nettoie les données du formulaire
        $data = [
            'title'       => htmlspecialchars(trim($_POST['title']       ?? '')),
            'destination' => htmlspecialchars(trim($_POST['destination'] ?? '')),
            'start_date'  => trim($_POST['start_date']                   ?? ''),
            'end_date'    => trim($_POST['end_date']                     ?? ''),
            'budget'      => trim($_POST['budget']                       ?? ''),
            'notes'       => htmlspecialchars(trim($_POST['notes']       ?? '')),
        ];

        // Validation des champs obligatoires
        if (empty($data['title']) || empty($data['destination'])) {
            $this->render('admin/projects/edit', [
                'error'   => 'Veuillez remplir tous les champs obligatoires.',
                'project' => $data,
            ]);
            return;
        }

        // On met à jour le projet en base de données
        $success = $this->travelProjectModel->update($id, $data);

        if ($success) {
            $this->redirect('admin/projects');
        } else {
            $this->render('admin/projects/edit', [
                'error'   => 'Une erreur est survenue. Veuillez réessayer.',
                'project' => $data,
            ]);
        }
    }

   
    // MAJ le statut d'un projet
    public function updateStatus(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/projects');
            return;
        }

        $status = trim($_POST['status'] ?? '');

        // On met à jour le statut du projet
        $this->travelProjectModel->updateStatus($id, $status);

        // On redirige vers le détail du projet
        $this->redirect('admin/projects/show/' . $id);
    }
}