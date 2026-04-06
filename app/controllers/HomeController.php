<?php

// Déclare le namespace 
namespace App\Controllers;

// On importe les Models dont on a besoin pour cette page
use App\Models\Article;
use App\Models\Type;

// HomeController gère la page d'accueil publique
class HomeController extends Controller
{
    // Les Models utilisés sur cette page
    private Article $articleModel;
    private Type $typeModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->articleModel = new Article();
        $this->typeModel    = new Type();
    }

    // -------------------------------------------------------------------------
    // Page d'accueil acessible par tous les visiteurs
    // -------------------------------------------------------------------------
    public function index(): void
    {
        // On récupère les derniers articles publiés, 1 par catégorie (max 3)
        $allArticles = $this->articleModel->findPublished();
        $articles = [];
        $seenCategories = [];
        foreach ($allArticles as $article) {
            $cat = $article['category_name'] ?? 'sans-categorie';
            if (!in_array($cat, $seenCategories)) {
                $seenCategories[] = $cat;
                $articles[] = $article;
            }
            if (count($articles) === 3) break;
        }

        $types = $this->typeModel->findAllWithMedia();

        // On envoie les données à la vue
        // La vue pourra utiliser $articles, $types et $destinations directement
        $this->render('public/home', [
            'articles'     => $articles,
            'types'        => $types
        ]);
    }
}