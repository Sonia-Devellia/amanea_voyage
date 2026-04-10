<?php

// On déclare le namespace
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Travel;
use App\Models\Destination;

// AdminTravelController gère le CRUD des voyages depuis le back-office
// Toutes les méthodes sont réservées à Nora (admin connectée)
class AdminTravelController extends Controller
{
    private Travel      $travelModel;
    private Destination $destinationModel;

    public function __construct()
    {
        $this->travelModel      = new Travel();
        $this->destinationModel = new Destination();
    }


    // Liste tous les voyages
    public function index(): void
    {
        $this->requireAdmin();

        $this->render('admin/travels/index', [
            'travels' => $this->travelModel->findAll(),
        ]);
    }


    // Affiche le formulaire de création
    public function create(): void
    {
        $this->requireAdmin();

        $this->render('admin/travels/create', [
            'destinations' => $this->destinationModel->findAll(),
        ]);
    }


    // Enregistre le nouveau voyage + ses étapes en base
    public function store(): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/travels/new');
            return;
        }

        [$data, $steps] = $this->extractFormData();

        if (empty($data['title'])) {
            $this->render('admin/travels/create', [
                'error'        => 'Le titre est obligatoire.',
                'data'         => $data,
                'destinations' => $this->destinationModel->findAll(),
            ]);
            return;
        }

        $success = $this->travelModel->create($data);

        if ($success) {
            $this->travelModel->replaceSteps($this->travelModel->getLastId(), $steps);
            $this->redirect('admin/travels');
        } else {
            $this->render('admin/travels/create', [
                'error'        => 'Une erreur est survenue. Veuillez réessayer.',
                'data'         => $data,
                'destinations' => $this->destinationModel->findAll(),
            ]);
        }
    }


    // Affiche le formulaire de modification avec les étapes existantes
    public function edit(int $id): void
    {
        $this->requireAdmin();

        $travel = $this->travelModel->findById($id);

        if (!$travel) {
            $this->redirect('admin/travels');
            return;
        }

        $steps     = $this->travelModel->getSteps($id);
        $stepsRaw  = implode("\n", $steps);

        $this->render('admin/travels/edit', [
            'travel'       => $travel,
            'steps_raw'    => $stepsRaw,
            'destinations' => $this->destinationModel->findAll(),
        ]);
    }


    // Enregistre les modifications + remplace les étapes
    public function update(int $id): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/travels/edit/' . $id);
            return;
        }

        [$data, $steps] = $this->extractFormData();

        if (empty($data['title'])) {
            $this->render('admin/travels/edit', [
                'error'        => 'Le titre est obligatoire.',
                'travel'       => array_merge(['Id_TRAVEL' => $id], $data),
                'steps_raw'    => implode("\n", $steps),
                'destinations' => $this->destinationModel->findAll(),
            ]);
            return;
        }

        $success = $this->travelModel->update($id, $data);

        if ($success) {
            $this->travelModel->replaceSteps($id, $steps);
            $this->redirect('admin/travels');
        } else {
            $this->render('admin/travels/edit', [
                'error'        => 'Une erreur est survenue. Veuillez réessayer.',
                'travel'       => array_merge(['Id_TRAVEL' => $id], $data),
                'steps_raw'    => implode("\n", $steps),
                'destinations' => $this->destinationModel->findAll(),
            ]);
        }
    }


    // Supprime un voyage (CASCADE supprime les TRAVEL_STEP liés)
    public function delete(int $id): void
    {
        $this->requireAdmin();

        $this->travelModel->delete($id);
        $this->redirect('admin/travels');
    }


    // -------------------------------------------------------------------------
    // Extrait et nettoie les données du formulaire
    // Retourne [$data, $steps] — les étapes sont un tableau de labels
    // -------------------------------------------------------------------------
    private function extractFormData(): array
    {
        $allowed_colors = ['#C58A60', '#9B6030', '#4A3C32', '#6C7E8F', '#A4B3A1', '#C3998A', '#EADFC9'];
        $badge_color    = $_POST['badge_color'] ?? '#C58A60';
        $badge_text     = $_POST['badge_text']  ?? '#ffffff';
        $id_destination = (int) ($_POST['id_destination'] ?? 0);

        // Étapes : textarea une-par-ligne → tableau de labels nettoyés
        $raw   = trim($_POST['steps'] ?? '');
        $steps = $raw
            ? array_values(array_filter(array_map('trim', explode("\n", $raw))))
            : [];

        $data = [
            'title'          => htmlspecialchars(trim($_POST['title']       ?? '')),
            'id_destination' => $id_destination > 0 ? $id_destination : null,
            'badge'          => htmlspecialchars(trim($_POST['badge']       ?? '')),
            'badge_color'    => in_array($badge_color, $allowed_colors) ? $badge_color : '#C58A60',
            'badge_text'     => in_array($badge_text, ['#ffffff', '#4A3C32']) ? $badge_text : '#ffffff',
            'cover_image'    => htmlspecialchars(trim($_POST['cover_image'] ?? '')),
            'duration'       => htmlspecialchars(trim($_POST['duration']    ?? '')),
            'persons'        => htmlspecialchars(trim($_POST['persons']     ?? '')),
            'season'         => htmlspecialchars(trim($_POST['season']      ?? '')),
            'description'    => trim($_POST['description']                  ?? ''),
            'price'          => htmlspecialchars(trim($_POST['price']       ?? '')),
            'is_published'   => isset($_POST['is_published']),
        ];

        return [$data, $steps];
    }
}
