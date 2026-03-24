<?php

// On déclare le namespace 
namespace App\Controllers;

// On importe les Models 
use App\Models\Type;
use App\Models\Article;

// TypeController gère les pages des formules de voyage (de noces, au féminin, de groupe, personnalisé)
class TypeController extends Controller
{
    // Les Models utilisés dans ce Controller
    private Type $typeModel;
    private Article $articleModel;

    // Le constructeur instancie les Models 
    public function __construct()
    {
        $this->typeModel    = new Type();
        $this->articleModel = new Article();
    }

    // Liste toutes les formules de voyage accessible par tous les visiteurs
     public function index(): void
    {
        // On récupère toutes les formules avec leur image associée
        $types = $this->typeModel->findAllWithMedia();

        $this->render('public/types', [
            'types' => $types,
        ]);
    }

    // Affiche le détail d'une formule de voyage
    public function show(string $slug): void
    {
        // On récupère la formule par son slug avec son image
        $type = $this->typeModel->findBySlug($slug);

        // Si la formule n'existe pas on redirige vers la liste
        if (!$type) {
            $this->redirect('type');
        }

        // On récupère la formule avec son image
        $typeWithMedia = $this->typeModel->findWithMedia($type['Id_TYPE']);

        $this->render('public/type', [
            'type' => $typeWithMedia,
        ]);
    }
}