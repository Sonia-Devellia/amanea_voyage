<?php

// On déclare le namespace 
namespace App\Controllers;

// AproposController gère la page "L'Histoire d'Amanéa"
// C'est une page statique, pas de connexion à la base de données
class AproposController extends Controller
{
    // -------------------------------------------------------------------------
    // Page "L'Histoire d'Amanéa"
    // Affiche le portrait de Nora, les valeurs de la marque et la méthode de travail
    // -------------------------------------------------------------------------
    public function index(): void
    {
        $this->render('public/apropos');
    }
}