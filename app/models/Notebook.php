<?php

// On déclare le namespace 
namespace App\Models;

// Notebook hérite de Model
class Notebook extends Model
{
    // Nom de la table en base de données
    protected string $table = 'NOTEBOOK';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_NOTEBOOK';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouveau carnet de voyage en bd $data contient le nom du fichier PDF et l'id du projet associé
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (pdf_file, upload_date)
            VALUES (:pdf_file, :upload_date)
        ");

        return $stmt->execute([
            ':pdf_file'    => $data['pdf_file'],
            ':upload_date' => date('Y-m-d H:i:s'),
        ]);
    }

    // -------------------------------------------------------------------------
    // Met à jour le fichier PDF d'un carnet existant
    // Utilisé quand l'admin remplace le carnet d'un projet
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET pdf_file    = :pdf_file,
                upload_date = :upload_date
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':pdf_file'    => $data['pdf_file'],
            ':upload_date' => date('Y-m-d H:i:s'),
            ':id'          => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Récupère le carnet lié à un projet de voyage
    // Retourne les données du carnet ou false si aucun carnet n'existe
    // -------------------------------------------------------------------------
    public function findByTravelProject(int $idTravelProject): array|false
    {
        $stmt = $this->db->prepare("
            SELECT n.* FROM {$this->table} n
            INNER JOIN TRAVEL_PROJECT tp ON tp.Id_NOTEBOOK = n.Id_NOTEBOOK
            WHERE tp.Id_TRAVEL_PROJECT = :id_travel_project
        ");

        $stmt->execute([':id_travel_project' => $idTravelProject]);
        return $stmt->fetch();
    }
}