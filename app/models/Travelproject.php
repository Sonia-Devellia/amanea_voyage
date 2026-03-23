<?php

// On déclare le namespace 
namespace App\Models;

// TravelProject hérite de Model 
class TravelProject extends Model
{
    // Nom de la table en base de données
    protected string $table = 'TRAVEL_PROJECT';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_TRAVEL_PROJECT';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouveau projet de voyage en base de données $data contient les informations saisies
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (title, destination, start_date, end_date, budget, status, notes, Id_USER)
            VALUES
                (:title, :destination, :start_date, :end_date, :budget, :status, :notes, :id_user)
        ");

        return $stmt->execute([
            ':title'       => $data['title'],
            ':destination' => $data['destination'],
            ':start_date'  => $data['start_date'],
            ':end_date'    => $data['end_date'],
            ':budget'      => $data['budget'],
            ':status'      => 'en_attente',
            ':notes'       => $data['notes'] ?? null,
            ':id_user'     => $data['id_user'],
        ]);
    }

    // -------------------------------------------------------------------------
    // Met à jour les informations d'un projet de voyage existant
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET title       = :title,
                destination = :destination,
                start_date  = :start_date,
                end_date    = :end_date,
                budget      = :budget,
                notes       = :notes
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':title'       => $data['title'],
            ':destination' => $data['destination'],
            ':start_date'  => $data['start_date'],
            ':end_date'    => $data['end_date'],
            ':budget'      => $data['budget'],
            ':notes'       => $data['notes'] ?? null,
            ':id'          => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Met à jour uniquement le statut d'un projet utilisé par l'admin pour faire avancer le projet
    // -------------------------------------------------------------------------
    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET status = :status
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':status' => $status,
            ':id'     => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Récupère tous les projets d'un utilisateur
    // Utilisé dans l'espace client pour afficher ses projets
    // -------------------------------------------------------------------------
    public function findByUser(int $idUser): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE Id_USER = :id_user
            ORDER BY Id_TRAVEL_PROJECT DESC
        ");

        $stmt->execute([':id_user' => $idUser]);
        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Récupère tous les projets avec le statut donné
    // Utilisé dans le back-office pour filtrer les projets
    // -------------------------------------------------------------------------
    public function findByStatus(string $status): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE status = :status
            ORDER BY Id_TRAVEL_PROJECT DESC
        ");

        $stmt->execute([':status' => $status]);
        return $stmt->fetchAll();
    }
}