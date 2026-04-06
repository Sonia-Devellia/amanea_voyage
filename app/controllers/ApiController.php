<?php

// ============================================================
// app/controllers/ApiController.php
// Endpoints JSON consommés par le frontend
// ============================================================

namespace App\Controllers;

use App\Services\PexelsService;

class ApiController extends Controller
{
    // -------------------------------------------------------------------------
    // GET /api/pexels-photo?keyword=...
    // Retourne {"url": "https://..."} ou {"url": null}
    // -------------------------------------------------------------------------
    public function pexelsPhoto(): void
    {
        header('Content-Type: application/json');

        $keyword = trim($_GET['keyword'] ?? '');
        $seed    = abs((int)($_GET['seed'] ?? 0));

        if (empty($keyword)) {
            echo json_encode(['url' => null]);
            return;
        }

        $pexels = new PexelsService();
        $url    = $pexels->getPhoto($keyword, 'large', $seed);

        echo json_encode(['url' => $url]);
    }
}
