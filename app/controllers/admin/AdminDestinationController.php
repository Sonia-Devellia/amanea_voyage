<?php

// On déclare le namespace
namespace App\Controllers\Admin;

// On importe la classe parente et le Model
use App\Controllers\Controller;
use App\Models\Destination;

// AdminDestinationController gère le CRUD des destinations depuis le back-office
// Toutes les méthodes sont réservées à Nora (admin connectée)
class AdminDestinationController extends Controller
{
    // Le Model utilisé dans ce Controller
    private Destination $destinationModel;

    // Le constructeur instancie le Model
    public function __construct()
    {
        $this->destinationModel = new Destination();
    }


    // Liste toutes les destinations
    public function index(): void
    {
        $this->requireAdmin();

        $destinations = $this->destinationModel->findAll();

        $this->render('admin/destinations/index', [
            'destinations' => $destinations,
        ]);
    }


    // Affiche le formulaire de création d'une destination
    public function create(): void
    {
        $this->requireAdmin();

        $this->render('admin/destinations/create');
    }


    // Enregistre la nouvelle destination en base
    public function store(): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/destinations/new');
            return;
        }

        $data = $this->extractFormData();

        if (empty($data['name']) || empty($data['slug'])) {
            $this->render('admin/destinations/create', [
                'error' => 'Le nom et le slug sont obligatoires.',
                'data'  => $data,
            ]);
            return;
        }

        $success = $this->destinationModel->create($data);

        if ($success) {
            $this->redirect('admin/destinations');
        } else {
            $this->render('admin/destinations/create', [
                'error' => 'Une erreur est survenue. Veuillez réessayer.',
                'data'  => $data,
            ]);
        }
    }


    // Affiche le formulaire de modification d'une destination
    public function edit(int $id): void
    {
        $this->requireAdmin();

        $destination = $this->destinationModel->findById($id);

        if (!$destination) {
            $this->redirect('admin/destinations');
            return;
        }

        $this->render('admin/destinations/edit', [
            'destination'    => $destination,
            'articlesCount'  => $this->destinationModel->countArticles($id),
        ]);
    }


    // Enregistre les modifications en base
    public function update(int $id): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/destinations/edit/' . $id);
            return;
        }

        $data = $this->extractFormData();

        if (empty($data['name']) || empty($data['slug'])) {
            $this->render('admin/destinations/edit', [
                'error'       => 'Le nom et le slug sont obligatoires.',
                'destination' => array_merge(['Id_DESTINATION' => $id], $data),
            ]);
            return;
        }

        $success = $this->destinationModel->update($id, $data);

        if ($success) {
            $this->redirect('admin/destinations');
        } else {
            $this->render('admin/destinations/edit', [
                'error'       => 'Une erreur est survenue. Veuillez réessayer.',
                'destination' => array_merge(['Id_DESTINATION' => $id], $data),
            ]);
        }
    }


    // Supprime une destination — bloqué si des articles y sont liés
    public function delete(int $id): void
    {
        $this->requireAdmin();

        $success = $this->destinationModel->delete($id);

        if (!$success) {
            // Des articles sont liés : on redirige avec un message d'erreur
            $destination   = $this->destinationModel->findById($id);
            $articlesCount = $this->destinationModel->countArticles($id);

            $this->render('admin/destinations/edit', [
                'destination'   => $destination,
                'articlesCount' => $articlesCount,
                'error'         => "Impossible de supprimer cette destination : {$articlesCount} article(s) y sont liés. Désassociez-les d'abord dans la gestion des articles.",
            ]);
            return;
        }

        $this->redirect('admin/destinations');
    }


    // Extrait et nettoie les données du formulaire
    private function extractFormData(): array
    {
        $allowed_colors = ['#C58A60','#9B6030','#FEF6ED','#4A3C32','#6C7E8F','#A4B3A1','#C3998A','#EADFC9'];
        $tag_color      = $_POST['tag_color'] ?? '';

        return [
            'name'           => htmlspecialchars(trim($_POST['name']           ?? '')),
            'description'    => trim($_POST['description']                     ?? ''),
            'slug'           => htmlspecialchars(trim($_POST['slug']           ?? '')),
            'label'          => htmlspecialchars(trim($_POST['label']          ?? '')),
            'tag'            => htmlspecialchars(trim($_POST['tag']            ?? '')),
            'tag_color'      => in_array($tag_color, $allowed_colors) ? $tag_color : null,
            'cover_image'    => htmlspecialchars(trim($_POST['cover_image']    ?? '')),
            'pexels_keyword' => trim($_POST['pexels_keyword']                  ?? ''),
            'is_featured'    => isset($_POST['is_featured']),
        ];
    }
}
