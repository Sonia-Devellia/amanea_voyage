<?php

// On déclare le namespace 
namespace App\Models;

// Category hérite de Model 
class Category extends Model
{
    // Nom de la table en base de données
    protected string $table = 'CATEGORY';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_CATEGORY';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée une nouvelle catégorie en bd $data contient le nom et le slug de la catégorie
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (name, slug)
            VALUES (:name, :slug)
        ");

        return $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
        ]);
    }

    // -------------------------------------------------------------------------
    // MAJ une catégorie existante
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET name = :name,
                slug = :slug
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':id'   => $id,
        ]);
    }


    // Récupère une catégorie par son slug
   
    public function findBySlug(string $slug): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE slug = :slug"
        );

        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Récupère toutes les catégories d'un article
    // Fait une jointure sur la table BELONGS_TO
    // -------------------------------------------------------------------------
    public function findByArticle(int $idArticle): array
    {
        $stmt = $this->db->prepare("
            SELECT c.*
            FROM {$this->table} c
            INNER JOIN BELONGS_TO bt ON bt.Id_CATEGORY = c.Id_CATEGORY
            WHERE bt.Id_ARTICLE = :id_article
        ");

        $stmt->execute([':id_article' => $idArticle]);
        return $stmt->fetchAll();
    }
}