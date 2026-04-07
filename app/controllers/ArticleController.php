<?php

// On déclare le namespace 
namespace App\Controllers;

// On importe les Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Media;
use App\Services\PexelsService;

// ArticleController gère le blog public
class ArticleController extends Controller
{
    // Les Models utilisés dans ce Controller
    private Article $articleModel;
    private Category $categoryModel;
    private Destination $destinationModel;
    private Media $mediaModel;

    // Le constructeur instancie les Models dont on a besoin
    public function __construct()
    {
        $this->articleModel     = new Article();
        $this->categoryModel    = new Category();
        $this->destinationModel = new Destination();
        $this->mediaModel       = new Media();
    }

    
    // Liste tous les articles publiés accessible par tous les visiteurs
    public function index(): void
    {
        // Récupère tous les articles publiés
        $allArticles = $this->articleModel->findPublished();

        // Article à la une = le premier, retiré du pool paginé
        $featured = !empty($allArticles) ? array_shift($allArticles) : null;

        // Pagination — 6 articles par page
        $perPage     = 6;
        $totalItems  = count($allArticles);
        $totalPages  = (int) ceil($totalItems / $perPage);
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));
        $offset      = ($currentPage - 1) * $perPage;

        $articles = array_slice($allArticles, $offset, $perPage);

        $this->render('public/inspirations', [
            'featured'        => $featured,
            'articles'        => $articles,
            'categories'      => $this->categoryModel->findAll(),
            'destinations'    => $this->destinationModel->findAll(),
            'currentCategory' => null,
            'currentPage'     => $currentPage,
            'totalPages'      => $totalPages,
            'totalItems'      => $totalItems,
        ]);
    }

    // Affiche le détail d'un article accessible par tous les visiteurs

    public function show(string $slug): void
    {
        // On récupère l'article par son slug (avec catégorie et destination via JOIN)
        $article = $this->articleModel->findBySlug($slug);

        // Si l'article n'existe pas on redirige vers la page Inspirations et Conseils
        if (!$article) {
            $this->redirect('article');
        }

        // On récupère l'image de couverture de l'article depuis la BDD
        $cover = $this->mediaModel->findCoverByArticle($article['Id_ARTICLE']);

        // On récupère les photos de contenu de l'article depuis la BDD
        $medias = $this->mediaModel->findContentsByArticle($article['Id_ARTICLE']);

        // Mot-clé Pexels : article > destination > titre de l'article (3 niveaux de fallback)
        $keyword = $article['pexels_keyword']
            ?? $article['destination_pexels_keyword']
            ?? $article['title'];

        $pexels = new PexelsService();

        // Image de couverture : BDD prioritaire, Pexels en fallback
        // getPhotoSrcset() retourne ['src' => large2x_url, 'srcset' => "large2x 1880w, large 940w"]
        // → hero full-width net à toutes résolutions, un seul appel API
        $pexelsHero = null;
        if (empty($cover['file_name'])) {
            $pexelsHero = $pexels->getPhotoSrcset($keyword, (int) $article['Id_ARTICLE']);
        }

        // Galerie : BDD prioritaire, Pexels en fallback (6 photos)
        if (!empty($medias)) {
            $gallery = array_map(
                fn($m) => APP_URL . '/public/images/' . $m['file_name'],
                $medias
            );
        } else {
            $gallery = $pexels->getPhotos($keyword, 6, 'large');
        }

        $this->render('public/article', [
            'article'    => $article,
            'cover'      => $cover,
            'pexelsHero' => $pexelsHero,
            'gallery'    => $gallery,
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

        $this->render('public/inspirations', [
            'articles'        => $articles,
            'featured'        => null,
            'categories'      => $this->categoryModel->findAll(),
            'destinations'    => $this->destinationModel->findAll(),
            'currentCategory' => $category['slug'],
            'currentPage'     => 1,
            'totalPages'      => 1,
            'totalItems'      => count($articles),
        ]);
    }
}