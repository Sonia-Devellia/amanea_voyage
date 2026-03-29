<?php

// On déclare le namespace 
namespace App\Models;

// Message hérite de Model 
class Message extends Model
{
    // Nom de la table en bdd
    protected string $table = 'MESSAGE';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_MESSAGE';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouveau message de contact en bd $data contient les informations saisies dans le formulaire de contact
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (firstname, lastname, email, phone,
                 travel_type, destination, duration,
                 budget, travelers, departure_date, project,
                 status, sent_date)
            VALUES
                (:firstname, :lastname, :email, :phone,
                 :travel_type, :destination, :duration,
                 :budget, :travelers, :departure_date, :project,
                 :status, :sent_date)
        ");

        return $stmt->execute([
            ':firstname'      => $data['firstname'],
            ':lastname'       => $data['lastname'],
            ':email'          => $data['email'],
            ':phone'          => $data['phone'],
            ':travel_type'    => $data['travel_type'],
            ':destination'    => $data['destination']    ?: null,
            ':duration'       => $data['duration'],
            ':budget'         => $data['budget']         ?: null,
            ':travelers'      => $data['travelers'],
            ':departure_date' => $data['departure_date'] ?: null,
            ':project'        => $data['project'],
            ':status'         => 'non_lu',
            ':sent_date'      => date('Y-m-d H:i:s'),
        ]);
    }

   
    // MAJ le statut d'un message
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


    // Assigne un message à un admin, Appelé quand la gérante prend en charge un message
   public function assignToAdmin(int $idMessage, int $idAdmin): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET Id_ADMIN = :id_admin
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':id_admin' => $idAdmin,
            ':id'       => $idMessage,
        ]);
    }

    // -------------------------------------------------------------------------
    // Récupère tous les messages avec un statut donné
    // Utilisé pour filtrer les messages
    // -------------------------------------------------------------------------
    public function findByStatus(string $status): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE status = :status
            ORDER BY sent_date DESC
        ");

        $stmt->execute([':status' => $status]);
        return $stmt->fetchAll();
    }
}