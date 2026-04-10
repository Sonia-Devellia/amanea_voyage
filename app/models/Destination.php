<?php

// On déclare le namespace
namespace App\Models;

// Destination hérite de Model
class Destination extends Model
{
    // Nom de la table en base de données
    protected string $table = 'DESTINATION';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_DESTINATION';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Récupère toutes les destinations
    // -------------------------------------------------------------------------
    public function getAll(): array
    {
        $stmt = $this->db->query(
            "SELECT id_DESTINATION AS id, name, slug, pexels_keyword
         FROM DESTINATION
         ORDER BY name ASC"
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // -------------------------------------------------------------------------
    // Récupère une destination par son ID
    // -------------------------------------------------------------------------
    public function getFeatured(): array
    {
        $stmt = $this->db->query(
            "SELECT name, label, tag, tag_color, cover_image, slug
         FROM DESTINATION
         WHERE is_featured = 1
           AND cover_image IS NOT NULL
         ORDER BY name ASC"
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // -------------------------------------------------------------------------
    // Crée une nouvelle destination
    // $data : name, country, description, pexels_keyword, slug, label, tag, tag_color, cover_image
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (name, description, pexels_keyword, slug, label, tag, tag_color, cover_image, is_featured)
            VALUES
                (:name, :description, :pexels_keyword, :slug, :label, :tag, :tag_color, :cover_image, :is_featured)
        ");

        return $stmt->execute([
            ':name'           => $data['name'],
            ':description'    => $data['description']    ?? null,
            ':pexels_keyword' => $data['pexels_keyword'] ?? null,
            ':slug'           => $data['slug'],
            ':label'          => $data['label']          ?? null,
            ':tag'            => $data['tag']             ?? null,
            ':tag_color'      => $data['tag_color']       ?? null,
            ':cover_image'    => $data['cover_image']     ?? null,
            ':is_featured'    => isset($data['is_featured']) ? 1 : 0,
        ]);
    }

    // -------------------------------------------------------------------------
    // Met à jour une destination existante
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET name           = :name,
                description    = :description,
                pexels_keyword = :pexels_keyword,
                slug           = :slug,
                label          = :label,
                tag            = :tag,
                tag_color      = :tag_color,
                cover_image    = :cover_image
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':name'           => $data['name'],
            ':description'    => $data['description']    ?? null,
            ':pexels_keyword' => $data['pexels_keyword'] ?? null,
            ':slug'           => $data['slug'],
            ':label'          => $data['label']          ?? null,
            ':tag'            => $data['tag']             ?? null,
            ':tag_color'      => $data['tag_color']       ?? null,
            ':cover_image'    => $data['cover_image']     ?? null,
            ':id'             => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Supprime une destination — uniquement si aucun article ne la référence
    // Retourne true si supprimé, false si des articles sont liés
    // -------------------------------------------------------------------------
    public function delete(int $id): bool
    {
        // Vérification avant suppression pour éviter une erreur FK
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM ARTICLE WHERE Id_DESTINATION = :id"
        );
        $stmt->execute([':id' => $id]);

        if ((int) $stmt->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    // -------------------------------------------------------------------------
    // Récupère une destination par son slug
    // -------------------------------------------------------------------------
    public function findBySlug(string $slug): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE slug = :slug"
        );
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Compte le nombre d'articles liés à une destination
    // Utilisé dans la vue admin pour avertir avant suppression
    // -------------------------------------------------------------------------
    public function countArticles(int $id): int
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM ARTICLE WHERE Id_DESTINATION = :id"
        );
        $stmt->execute([':id' => $id]);
        return (int) $stmt->fetchColumn();
    }
}
