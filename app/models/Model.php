<?php

// On déclare le namespace : tous les Models sont dans App\Models
namespace App\Models;

// On importe la classe Database pour avoir accès à la connexion PDO
use Config\Database;
use PDO;

// abstract  sert de "modèle" pour tous les autres Models
abstract class Model
{
    // La connexion à la base de données (PDO)
    protected PDO $db;

    // Le nom de la table en base de données
    protected string $table;

    // Le nom de la clé primaire de la table
    protected string $primaryKey;

    // Le constructeur est appelé et récupère la connexion PDO via le Singleton Database
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    
    // Récupère tous les enregistrements de la table

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Récupère un seul enregistrement par son ID
    // Retourne un tableau associatif ou false si non trouvé
    // -------------------------------------------------------------------------
    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Supprime un enregistrement par son ID
    // Retourne true si la suppression a réussi, false sinon
    // -------------------------------------------------------------------------
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    // -------------------------------------------------------------------------
    // Ces deux méthodes sont écrites dans chaque Model enfant car chaque table a ses propres champs
    // Le mot clé "abstract" oblige les classes enfants à les implémenter
    // -------------------------------------------------------------------------
    abstract public function create(array $data): bool;
    abstract public function update(int $id, array $data): bool;
}