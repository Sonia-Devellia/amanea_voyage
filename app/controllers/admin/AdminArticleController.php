<?php

// On déclare le namespace 
namespace App\Controllers\Admin;

// On importe la classe parente et les Models dont on a besoin
use App\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Media;

// AdminArticleController gère la création et la modification des articles du blog
// Toutes les méthodes sont réservées à Nora (admin connectée)
class AdminArticleController extends Controller
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


    // Liste tous les articles ,affiche tous les articles (publiés et brouillons)
    public function index(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère tous les articles
        $articles = $this->articleModel->findAll();

        $this->render('admin/blog/index', [
            'articles' => $articles,
        ]);
    }

    // Affiche le formulaire de création d'un article
    public function create(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère les catégories et médias pour les listes déroulantes
        $categories = $this->categoryModel->findAll();
        $medias     = $this->mediaModel->findAll();

        $this->render('admin/blog/create', [
            'categories' => $categories,
            'medias'     => $medias,
        ]);
    }

    // -------------------------------------------------------------------------
    // Enregistre le nouvel article en bdd
    // Appelé quand Nora soumet le formulaire de création
    // -------------------------------------------------------------------------
    public function store(): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/blog/new');
            return;
        }

        // On récupère et nettoie les données du formulaire
        $data = [
            'title'          => htmlspecialchars(trim($_POST['title']       ?? '')),
            'content'        => trim($_POST['content']                      ?? ''),
            'slug'           => htmlspecialchars(trim($_POST['slug']        ?? '')),
            'id_media'       => !empty($_POST['id_media'])       ? (int) $_POST['id_media']       : null,
            'id_admin'       => $_SESSION['admin']['id'],
            // id_destination est renseigné uniquement si la catégorie est "Destination"
            // Il est saisi manuellement et sert à alimenter l'API Pexels
            'id_destination' => !empty($_POST['id_destination']) ? (int) $_POST['id_destination'] : null,
        ];

        // Validation des champs obligatoires
        if (empty($data['title']) || empty($data['content']) || empty($data['slug'])) {
            $this->render('admin/blog/create', [
                'error'      => 'Veuillez remplir tous les champs obligatoires.',
                'data'       => $data,
                'categories' => $this->categoryModel->findAll(),
                'medias'     => $this->mediaModel->findAll(),
            ]);
            return;
        }

        // On crée l'article en base de données
        $success = $this->articleModel->create($data);

        if ($success) {
            $this->redirect('admin/blog');
        } else {
            $this->render('admin/blog/create', [
                'error'      => 'Une erreur est survenue. Veuillez réessayer.',
                'data'       => $data,
                'categories' => $this->categoryModel->findAll(),
                'medias'     => $this->mediaModel->findAll(),
            ]);
        }
    }


    // Affiche le formulaire de modification d'un article
    public function edit(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On récupère l'article à modifier
        $article = $this->articleModel->findById($id);

        // Si l'article n'existe pas on redirige vers la liste
        if (!$article) {
            $this->redirect('admin/blog');
            return;
        }

        // On récupère les catégories et médias pour les listes déroulantes
        $categories = $this->categoryModel->findAll();
        $medias     = $this->mediaModel->findAll();

        $this->render('admin/blog/edit', [
            'article'    => $article,
            'categories' => $categories,
            'medias'     => $medias,
        ]);
    }


    // Enregistre les modifications d'un article en bdd
    public function update(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/blog/edit/' . $id);
            return;
        }

        // On récupère et nettoie les données du formulaire
        $data = [
            'title'          => htmlspecialchars(trim($_POST['title']       ?? '')),
            'content'        => trim($_POST['content']                      ?? ''),
            'slug'           => htmlspecialchars(trim($_POST['slug']        ?? '')),
            'id_media'       => !empty($_POST['id_media'])       ? (int) $_POST['id_media']       : null,
            'id_destination' => !empty($_POST['id_destination']) ? (int) $_POST['id_destination'] : null,
        ];

        // Validation des champs obligatoires
        if (empty($data['title']) || empty($data['content']) || empty($data['slug'])) {
            $this->render('admin/blog/edit', [
                'error'      => 'Veuillez remplir tous les champs obligatoires.',
                'article'    => $data,
                'categories' => $this->categoryModel->findAll(),
                'medias'     => $this->mediaModel->findAll(),
            ]);
            return;
        }

        // On met à jour l'article en bdd
        $success = $this->articleModel->update($id, $data);

        if ($success) {
            $this->redirect('admin/blog');
        } else {
            $this->render('admin/blog/edit', [
                'error'      => 'Une erreur est survenue. Veuillez réessayer.',
                'article'    => $data,
                'categories' => $this->categoryModel->findAll(),
                'medias'     => $this->mediaModel->findAll(),
            ]);
        }
    }


    // Publie un article — passe son statut de 'brouillon' à 'publie'
    public function publish(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->articleModel->publish($id);
        $this->redirect('admin/blog');
    }

  
    // Supprime un article
    public function delete(int $id): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        $this->articleModel->delete($id);
        $this->redirect('admin/blog');
    }

    
    // Ajoute un média dans le contenu d'un article (CONTAINS_CONTENTS)
    public function addMedia(int $idArticle): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/blog/edit/' . $idArticle);
            return;
        }

        $idMedia = (int) ($_POST['id_media'] ?? 0);

        // On vérifie que l'id du média est bien renseigné
        if (empty($idMedia)) {
            $this->redirect('admin/blog/edit/' . $idArticle);
            return;
        }

        // On ajoute le média dans le contenu de l'article via CONTAINS_CONTENTS
        $this->articleModel->addMedia($idArticle, $idMedia);

        // On redirige vers le formulaire de modification de l'article
        $this->redirect('admin/blog/edit/' . $idArticle);
    }

    // Supprime un média du contenu d'un article (CONTAINS_CONTENTS)
    public function removeMedia(int $idArticle): void
    {
        // On vérifie que l'admin est bien connecté
        $this->requireAdmin();

        // On vérifie que la requête vient bien d'un formulaire POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/blog/edit/' . $idArticle);
            return;
        }

        $idMedia = (int) ($_POST['id_media'] ?? 0);

        // On vérifie que l'id du média est bien renseigné
        if (empty($idMedia)) {
            $this->redirect('admin/blog/edit/' . $idArticle);
            return;
        }

        // On supprime le lien entre l'article et le média dans CONTAINS_CONTENTS
        $this->articleModel->removeMedia($idArticle, $idMedia);

        // On redirige vers le formulaire de modification de l'article
        $this->redirect('admin/blog/edit/' . $idArticle);
    }
}