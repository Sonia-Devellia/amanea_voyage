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
    // Crée une nouvelle destination en bd $data contient le nom, le pays, la description, le mot clé pexels et le slug
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (name, country, description, pexels_keyword, slug)
            VALUES
                (:name, :country, :description, :pexels_keyword, :slug)
        ");

        return $stmt->execute([
            ':name'           => $data['name'],
            ':country'        => $data['country'],
            ':description'    => $data['description']    ?? null,
            ':pexels_keyword' => $data['pexels_keyword'] ?? null,
            ':slug'           => $data['slug'],
        ]);
    }

    
    // MAJ une destination existante
   
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET name           = :name,
                country        = :country,
                description    = :description,
                pexels_keyword = :pexels_keyword,
                slug           = :slug
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':name'           => $data['name'],
            ':country'        => $data['country'],
            ':description'    => $data['description']    ?? null,
            ':pexels_keyword' => $data['pexels_keyword'] ?? null,
            ':slug'           => $data['slug'],
            ':id'             => $id,
        ]);
    }

    
    // Récupère une destination par son slug
    
    public function findBySlug(string $slug): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE slug = :slug"
        );

        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Récupère toutes les destinations d'un pays donné
    // Utilisé pour filtrer les destinations par pays
    // -------------------------------------------------------------------------
    public function findByCountry(string $country): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE country = :country"
        );

        $stmt->execute([':country' => $country]);
        return $stmt->fetchAll();
    }
}