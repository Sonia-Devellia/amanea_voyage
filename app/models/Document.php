<?php

// On déclare le namespace 
namespace App\Models;

// Document hérite de Model 
class Document extends Model
{
    // Nom de la table en bdd
    protected string $table = 'DOCUMENT';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_DOCUMENT';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouveau document en bd $data contient le type, le fichier PDF, le statut et l'id du projet
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (type, pdf_file, status, upload_date, Id_TRAVEL_PROJECT)
            VALUES
                (:type, :pdf_file, :status, :upload_date, :id_travel_project)
        ");

        return $stmt->execute([
            ':type'              => $data['type'],
            ':pdf_file'          => $data['pdf_file'],
            ':status'            => 'en_attente',
            ':upload_date'       => date('Y-m-d H:i:s'),
            ':id_travel_project' => $data['id_travel_project'],
        ]);
    }

    // -------------------------------------------------------------------------
    // MAJ le statut d'un document existant
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET status = :status
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':status' => $data['status'],
            ':id'     => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Récupère tous les documents liés à un projet de voyage
    // Utilisé pour afficher les documents dans l'espace client et le back-office
    // -------------------------------------------------------------------------
    public function findByTravelProject(int $idTravelProject): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE Id_TRAVEL_PROJECT = :id_travel_project
            ORDER BY upload_date DESC
        ");

        $stmt->execute([':id_travel_project' => $idTravelProject]);
        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Récupère tous les documents d'un type précis pour un projet
    // -------------------------------------------------------------------------
    public function findByType(int $idTravelProject, string $type): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE Id_TRAVEL_PROJECT = :id_travel_project
            AND type = :type
            ORDER BY upload_date DESC
        ");

        $stmt->execute([
            ':id_travel_project' => $idTravelProject,
            ':type'              => $type,
        ]);
        return $stmt->fetchAll();
    }
}