<?php

// On déclare le namespace 
namespace App\Models;

// Article hérite de Model 
class Article extends Model
{
    // Nom de la table en base de données
    protected string $table = 'ARTICLE';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_ARTICLE';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouvel article en bd $data contient le titre, le contenu, le slug et l'id de l'admin
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (title, content, status, publication_date, slug, Id_MEDIA, Id_ADMIN, Id_DESTINATION)
            VALUES
                (:title, :content, :status, :publication_date, :slug, :id_media, :id_admin, :id_destination)
        ");

        return $stmt->execute([
            ':title'            => $data['title'],
            ':content'          => $data['content'],
            ':status'           => 'brouillon',
            ':publication_date' => null,
            ':slug'             => $data['slug'],
            ':id_media'         => $data['id_media']       ?? null,
            ':id_admin'         => $data['id_admin'],
            ':id_destination'   => $data['id_destination'] ?? null,
        ]);
    }

   
    // MAJ un article existant
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET title          = :title,
                content        = :content,
                slug           = :slug,
                Id_MEDIA       = :id_media,
                Id_DESTINATION = :id_destination
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':title'          => $data['title'],
            ':content'        => $data['content'],
            ':slug'           => $data['slug'],
            ':id_media'       => $data['id_media']       ?? null,
            ':id_destination' => $data['id_destination'] ?? null,
            ':id'             => $id,
        ]);
    }

   
    // Publie un article : passe le statut à 'publie' et enregistre la date de publication
   public function publish(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET status           = 'publie',
                publication_date = :publication_date
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':publication_date' => date('Y-m-d H:i:s'),
            ':id'               => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Récupère uniquement les articles publiés
    // Utilisé sur la page Inspirations et Conseils
    // -------------------------------------------------------------------------
    public function findPublished(): array
    {
        $stmt = $this->db->query("
            SELECT * FROM {$this->table}
            WHERE status = 'publie'
            ORDER BY publication_date DESC
        ");

        return $stmt->fetchAll();
    }

   
    // Récupère un article par son slug
    public function findBySlug(string $slug): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE slug = :slug"
        );

        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Récupère tous les articles d'une catégorie
    // Fait une jointure sur la table BELONGS_TO
    // -------------------------------------------------------------------------
    public function findByCategory(int $idCategory): array
    {
        $stmt = $this->db->prepare("
            SELECT a.*
            FROM {$this->table} a
            INNER JOIN BELONGS_TO bt ON bt.Id_ARTICLE = a.Id_ARTICLE
            WHERE bt.Id_CATEGORY = :id_category
            AND a.status = 'publie'
            ORDER BY a.publication_date DESC
        ");

        $stmt->execute([':id_category' => $idCategory]);
        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------------------
    // Récupère tous les articles liés à une destination
    // Utilisé pour afficher les articles de la catégorie destination et utilse l'API Pexels
    // -------------------------------------------------------------------------------------
    public function findByDestination(int $idDestination): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE Id_DESTINATION = :id_destination
            AND status = 'publie'
            ORDER BY publication_date DESC
        ");

        $stmt->execute([':id_destination' => $idDestination]);
        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Ajoute un média dans le contenu d'un article
    // Insère une ligne dans la table de liaison CONTAINS_CONTENTS
    // -------------------------------------------------------------------------
    public function addMedia(int $idArticle, int $idMedia): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO CONTAINS_CONTENTS (Id_ARTICLE, Id_MEDIA)
            VALUES (:id_article, :id_media)
        ");

        return $stmt->execute([
            ':id_article' => $idArticle,
            ':id_media'   => $idMedia,
        ]);
    }

    // -------------------------------------------------------------------------
    // Supprime un média du contenu d'un article
    // Supprime la ligne correspondante dans CONTAINS_CONTENTS
    // -------------------------------------------------------------------------
    public function removeMedia(int $idArticle, int $idMedia): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM CONTAINS_CONTENTS
            WHERE Id_ARTICLE = :id_article
            AND Id_MEDIA = :id_media
        ");

        return $stmt->execute([
            ':id_article' => $idArticle,
            ':id_media'   => $idMedia,
        ]);
    }

    // -------------------------------------------------------------------------
    // MAJ uniquement l'image de couverture d'un article
    // Modifie la colonne Id_MEDIA directement dans la table ARTICLE
    // -------------------------------------------------------------------------
    public function updateCover(int $idArticle, int $idMedia): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET Id_MEDIA = :id_media
            WHERE {$this->primaryKey} = :id
        ");
 
        return $stmt->execute([
            ':id_media' => $idMedia,
            ':id'       => $idArticle,
        ]);
    }

 

    // -------------------------------------------------------------------------
    // Ajoute une catégorie à un article
    // Insère une ligne dans la table de liaison BELONGS_TO
    // -------------------------------------------------------------------------
    public function addCategory(int $idArticle, int $idCategory): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO BELONGS_TO (Id_CATEGORY, Id_ARTICLE)
            VALUES (:id_category, :id_article)
        ");

        return $stmt->execute([
            ':id_category' => $idCategory,
            ':id_article'  => $idArticle,
        ]);
    }

    // -------------------------------------------------------------------------
    // Supprime une catégorie d'un article
    // Supprime la ligne correspondante dans BELONGS_TO
    // -------------------------------------------------------------------------
    public function removeCategory(int $idArticle, int $idCategory): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM BELONGS_TO
            WHERE Id_ARTICLE  = :id_article
            AND Id_CATEGORY = :id_category
        ");

        return $stmt->execute([
            ':id_article'  => $idArticle,
            ':id_category' => $idCategory,
        ]);
    }
}