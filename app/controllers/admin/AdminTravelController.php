<?php

// On déclare le namespace
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Travel;
use App\Models\Destination;
use App\Models\Type;
use App\Models\Media;

// AdminTravelController gère le CRUD des voyages depuis le back-office
// Toutes les méthodes sont réservées à Nora (admin connectée)
class AdminTravelController extends Controller
{
    private Travel      $travelModel;
    private Destination $destinationModel;
    private Type        $typeModel;
    private Media       $mediaModel;

    public function __construct()
    {
        $this->travelModel      = new Travel();
        $this->destinationModel = new Destination();
        $this->typeModel        = new Type();
        $this->mediaModel       = new Media();
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
            'types'        => $this->typeModel->findAll(),
            'medias'       => $this->mediaModel->findAll(),
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
                'types'        => $this->typeModel->findAll(),
                'medias'       => $this->mediaModel->findAll(),
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
                'types'        => $this->typeModel->findAll(),
                'medias'       => $this->mediaModel->findAll(),
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

        // Étapes structurées → textarea "Ville · N" par ligne
        $rawSteps = $this->travelModel->getSteps($id);
        $stepsRaw = implode("\n", array_map(
            fn($s) => $s['city'] . ($s['nights'] ? ' · ' . $s['nights'] : ''),
            $rawSteps
        ));

        $this->render('admin/travels/edit', [
            'travel'       => $travel,
            'steps_raw'    => $stepsRaw,
            'destinations' => $this->destinationModel->findAll(),
            'types'        => $this->typeModel->findAll(),
            'medias'       => $this->mediaModel->findAll(),
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
                'steps_raw'    => $_POST['steps'] ?? '',
                'destinations' => $this->destinationModel->findAll(),
                'types'        => $this->typeModel->findAll(),
                'medias'       => $this->mediaModel->findAll(),
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
                'steps_raw'    => $_POST['steps'] ?? '',
                'destinations' => $this->destinationModel->findAll(),
                'types'        => $this->typeModel->findAll(),
                'medias'       => $this->mediaModel->findAll(),
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
    // Retourne [$data, $steps] — $steps est un tableau de ['city', 'nights']
    // Format textarea : "Ville · N" par ligne (N = nombre de nuits)
    // -------------------------------------------------------------------------
    private function extractFormData(): array
    {
        $id_destination = (int) ($_POST['id_destination'] ?? 0);
        $id_type        = (int) ($_POST['id_type']        ?? 0);
        $id_media       = (int) ($_POST['id_media']       ?? 0);

        // Étapes : "Ville · N" par ligne → [['city' => ..., 'nights' => N], ...]
        $raw   = trim($_POST['steps'] ?? '');
        $steps = [];
        if ($raw) {
            foreach (array_filter(array_map('trim', explode("\n", $raw))) as $line) {
                $parts   = array_map('trim', explode('·', $line));
                $steps[] = [
                    'city'   => $parts[0] ?? $line,
                    'nights' => isset($parts[1]) && is_numeric($parts[1]) ? (int) $parts[1] : null,
                ];
            }
        }

        $data = [
            'title'          => htmlspecialchars(trim($_POST['title']       ?? '')),
            'id_destination' => $id_destination > 0 ? $id_destination : null,
            'id_type'        => $id_type  > 0 ? $id_type  : null,
            'id_media'       => $id_media > 0 ? $id_media : null,
            'duration_days'  => !empty($_POST['duration_days']) ? (int) $_POST['duration_days'] : null,
            'min_persons'    => !empty($_POST['min_persons'])   ? (int) $_POST['min_persons']   : null,
            'max_persons'    => !empty($_POST['max_persons'])   ? (int) $_POST['max_persons']   : null,
            'season_start'   => !empty($_POST['season_start'])  ? (int) $_POST['season_start']  : null,
            'season_end'     => !empty($_POST['season_end'])    ? (int) $_POST['season_end']    : null,
            'description'    => trim($_POST['description']      ?? ''),
            'price'          => htmlspecialchars(trim($_POST['price'] ?? '')),
            'is_published'   => isset($_POST['is_published']),
        ];

        return [$data, $steps];
    }
}
