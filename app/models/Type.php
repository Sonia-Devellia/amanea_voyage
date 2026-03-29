<?php

// On déclare le namespace 
namespace App\Models;

// Type hérite de Model 
class Type extends Model
{
    // Nom de la table en bdd
    protected string $table = 'TYPE';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_TYPE';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // ---------------------------------------------------------------------------------------------------------------------------
    // Crée une nouvelle formule de voyage en bdd $data contient le titre, la description, le slug et l'id du média associé
    // Retourne true si l'insertion a réussi, false sinon
    // ---------------------------------------------------------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (title, description, slug, Id_MEDIA)
            VALUES
                (:title, :description, :slug, :id_media)
        ");

        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':slug'        => $data['slug'],
            ':id_media'    => $data['id_media'],
        ]);
    }

    
    // MAJ une formule de voyage existante
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET title       = :title,
                description = :description,
                slug        = :slug
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':slug'        => $data['slug'],
            ':id'          => $id,
        ]);
    }

    // Récupère une formule par son slug pour afficher la page d'une formule depuis son URL
    public function findBySlug(string $slug): array|false
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE slug = :slug
        ");

        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

   
    // Récupère une formule avec son image associée 
    public function findWithMedia(int $id): array|false
    {
        $stmt = $this->db->prepare("
            SELECT t.*, m.file_name, m.caption
            FROM {$this->table} t
            INNER JOIN MEDIA m ON t.Id_MEDIA = m.Id_MEDIA
            WHERE t.{$this->primaryKey} = :id
        ");

        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Récupère toutes les formules avec leur image associée
    // Utilisé pour afficher toutes les formules sur la page Voyage et Expérience
    // -------------------------------------------------------------------------
    public function findAllWithMedia(): array
    {
        $stmt = $this->db->query("
            SELECT t.*, m.file_name, m.caption
            FROM {$this->table} t
            INNER JOIN MEDIA m ON t.Id_MEDIA = m.Id_MEDIA
        ");

        return $stmt->fetchAll();
    }
}