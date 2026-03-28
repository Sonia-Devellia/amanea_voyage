<?php

// On déclare le namespace 
namespace App\Controllers\Admin;

// On importe la classe parente et le Model dont on a besoin
use App\Controllers\Controller;
use App\Models\Media;

// AdminMediaController gère le portfolio de médias du back-office
// Nora peut ajouter, modifier et supprimer des images depuis le back-office
class AdminMediaController extends Controller
{
    // Le Model utilisé dans ce Controller
    private Media $mediaModel;

    // Le constructeur instancie le Model dont on a besoin
    public function __construct()
    {
        $this->mediaModel = new Media();
    }

  
    // Liste tous les médias
    public function index(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère tous les médias
        $medias = $this->mediaModel->findAll();

        $this->render('admin/portfolio/index', [
            'medias' => $medias,
        ]);
    }

    // Affiche le formulaire d'ajout d'un média
    public function create(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->render('admin/portfolio/create');
    }

    // -------------------------------------------------------------------------
    // Enregistre le nouveau média en bdd
    // Gère l'upload du fichier image sur le serveur
    // -------------------------------------------------------------------------
    public function store(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/portfolio/new');
            return;
        }

        // On vérifie qu'un fichier a bien été envoyé
        if (empty($_FILES['file_name']) || $_FILES['file_name']['error'] !== UPLOAD_ERR_OK) {
            $this->render('admin/portfolio/create', [
                'error' => 'Veuillez sélectionner un fichier image.',
            ]);
            return;
        }

        // On vérifie que le fichier est bien une image
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $fileType     = mime_content_type($_FILES['file_name']['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            $this->render('admin/portfolio/create', [
                'error' => 'Seuls les formats JPG, PNG et WEBP sont acceptés.',
            ]);
            return;
        }

        // On génère un nom de fichier unique pour éviter les doublons
        // uniqid() génère un identifiant unique basé sur la date et l'heure
        $extension = pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION);
        $fileName  = uniqid('media_') . '.' . $extension;
        $uploadDir = APP_ROOT . '/public/images/uploads/';

        // On déplace le fichier depuis le dossier temporaire vers le dossier uploads
        if (!move_uploaded_file($_FILES['file_name']['tmp_name'], $uploadDir . $fileName)) {
            $this->render('admin/portfolio/create', [
                'error' => 'Une erreur est survenue lors de l\'upload. Veuillez réessayer.',
            ]);
            return;
        }

        // On enregistre le média en base de données
        $data = [
            'file_name' => $fileName,
            'caption'   => htmlspecialchars(trim($_POST['caption']   ?? '')),
            'copyright' => htmlspecialchars(trim($_POST['copyright'] ?? '')),
        ];

        $success = $this->mediaModel->create($data);

        if ($success) {
            $this->redirect('admin/portfolio');
        } else {
            $this->render('admin/portfolio/create', [
                'error' => 'Une erreur est survenue. Veuillez réessayer.',
            ]);
        }
    }

    // Affiche le formulaire de modification d'un média
    public function edit(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère le média à modifier
        $media = $this->mediaModel->findById($id);

        // Si le média n'existe pas on redirige vers la liste
        if (!$media) {
            $this->redirect('admin/portfolio');
            return;
        }

        $this->render('admin/portfolio/edit', [
            'media' => $media,
        ]);
    }

    // -------------------------------------------------------------------------
    // Enregistre les modifications d'un média en bdd
    // On peut modifier uniquement la légende et le copyright
    public function update(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/portfolio/edit/' . $id);
            return;
        }

        $data = [
            'caption'   => htmlspecialchars(trim($_POST['caption']   ?? '')),
            'copyright' => htmlspecialchars(trim($_POST['copyright'] ?? '')),
        ];

        $success = $this->mediaModel->update($id, $data);

        if ($success) {
            $this->redirect('admin/portfolio');
        } else {
            $this->render('admin/portfolio/edit', [
                'error' => 'Une erreur est survenue. Veuillez réessayer.',
                'media' => $data,
            ]);
        }
    }

    
    // Supprime un média
    public function delete(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère le média pour avoir le nom du fichier
        $media = $this->mediaModel->findById($id);

        if ($media) {
            // On supprime le fichier image du serveur
            $filePath = APP_ROOT . '/public/images/uploads/' . $media['file_name'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // On supprime le média de la base de données
            $this->mediaModel->delete($id);
        }

        $this->redirect('admin/portfolio');
    }
}