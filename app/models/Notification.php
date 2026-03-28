<?php

// On déclare le namespace 
namespace App\Models;

// Notification hérite de Model : il récupère automatiquement
// findAll(), findById() et delete()
class Notification extends Model
{
    // Nom de la table en base de données
    protected string $table = 'NOTIFICATION';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_NOTIFICATION';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée une nouvelle notification pour l'admin
    // $data contient le type, le message, l'id du client et l'id de l'admin
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (type, message, is_read, created_at, Id_USER, Id_ADMIN)
            VALUES
                (:type, :message, 0, :created_at, :id_user, :id_admin)
        ");

        return $stmt->execute([
            ':type'       => $data['type'],
            ':message'    => $data['message'],
            ':created_at' => date('Y-m-d H:i:s'),
            ':id_user'    => $data['id_user'],
            ':id_admin'   => $data['id_admin'],
        ]);
    }

    // -------------------------------------------------------------------------
    // Obligatoire car déclarée abstract dans Model.php
    // Non utilisée pour les notifications
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        return false;
    }

    // -------------------------------------------------------------------------
    // Récupère toutes les notifications non lues de l'admin
    // Utilisé dans le dashboard admin pour afficher les alertes
    // -------------------------------------------------------------------------
    public function findUnread(): array
    {
        $stmt = $this->db->query("
            SELECT n.*, u.first_name, u.last_name, u.email
            FROM {$this->table} n
            INNER JOIN USER u ON u.Id_USER = n.Id_USER
            WHERE n.is_read = 0
            ORDER BY n.created_at DESC
        ");

        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Marque une notification comme lue
    // Appelé quand Nora consulte la notification dans son dashboard
    // -------------------------------------------------------------------------
    public function markAsRead(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET is_read = 1
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([':id' => $id]);
    }

    // -------------------------------------------------------------------------
    // Marque toutes les notifications comme lues
    // -------------------------------------------------------------------------
    public function markAllAsRead(): bool
    {
        $stmt = $this->db->query("
            UPDATE {$this->table} SET is_read = 1 WHERE is_read = 0
        ");

        return $stmt !== false;
    }
}