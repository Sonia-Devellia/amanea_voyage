<?php

// On déclare le namespace 
namespace App\Controllers;

// On importe les Models 
use App\Models\Article;
use App\Models\Category;
use App\Models\Media;

// ArticleController gère le blog public
class ArticleController extends Controller
{
    // Les Models utilisés dans ce Controller
    private Article $articleModel;
    private Category $categoryModel;
    private Media $mediaModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->articleModel  = new Article();
        $this->categoryModel = new Category();
        $this->mediaModel    = new Media();
    }

    
    // Liste tous les articles publiés accessible par tous les visiteurs
    public function index(): void
    {
        // Récupère tous les articles publiés
        $articles = $this->articleModel->findPublished();

        // récupère toutes les catégories pour le menu de filtrage
        $categories = $this->categoryModel->findAll();

        $this->render('public/articles', [
            'articles'   => $articles,
            'categories' => $categories,
        ]);
    }

    // Affiche le détail d'un article accessible par tous les visiteurs

    public function show(string $slug): void
    {
        // On récupère l'article par son slug
        $article = $this->articleModel->findBySlug($slug);

        // Si l'article n'existe pas on redirige vers la page Inspirations et Conseils
        if (!$article) {
            $this->redirect('article');
        }

        // On récupère l'image de couverture de l'article
        $cover = $this->mediaModel->findCoverByArticle($article['Id_ARTICLE']);

        // On récupère les photos via media du contenu de l'article
        $medias = $this->mediaModel->findContentsByArticle($article['Id_ARTICLE']);

        // On récupère les catégories de l'article
        $categories = $this->categoryModel->findByArticle($article['Id_ARTICLE']);

        $this->render('public/article', [
            'article'    => $article,
            'cover'      => $cover,
            'medias'     => $medias,
            'categories' => $categories,
        ]);
    }

    
    // Affiche les articles d'une catégorie accessible par tous les visiteurs
    public function category(string $slug): void
    {
        // On récupère la catégorie par son slug
        $category = $this->categoryModel->findBySlug($slug);

        // Si la catégorie n'existe pas on redirige vers la page
        if (!$category) {
            $this->redirect('article');
        }

        // On récupère tous les articles publiés de cette catégorie
        $articles = $this->articleModel->findByCategory($category['Id_CATEGORY']);

        $this->render('public/articles', [
            'articles'        => $articles,
            'currentCategory' => $category,
            'categories'      => $this->categoryModel->findAll(),
        ]);
    }
}