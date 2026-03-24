<?php

// On déclare le namespace 
namespace App\Models;

// Admin hérite de Model
class Admin extends Model
{
    // Nom de la table en base de données
    protected string $table = 'ADMIN';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_ADMIN';

    // Le constructeur appelle celui du parent (Model) ce qui déclenche la connexion PDO via Database
    public function __construct()
    {
        parent::__construct();
    }


    // Crée un nouvel admin en bdd $data est un tableau contenant email et password ,true si l'insertion a réussi, false sinon
    public function create(array $data): bool
    {
        // On prépare la requête SQL avec des paramètres nommés (:nom) pour éviter les injections SQL
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (email, password)
            VALUES (:email, :password)
        ");

        // Le mot de passe est hashé avec bcrypt avant d'être enregistré
        return $stmt->execute([
            ':email'    => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);
    }


    // Met à jour l'email d'un admin existant
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET email = :email
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':email' => $data['email'],
            ':id'    => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Recherche un admin par son adresse email utilisé lors de la connexion au back-office
    // Retourne les données de l'admin ou false si non trouvé
    // -------------------------------------------------------------------------
    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE email = :email"
        );
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Vérifie que le mp saisi correspond au hash enregistré en BDD
    // Retourne true si le mp est correct, false sinon
    // -------------------------------------------------------------------------
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    // -------------------------------------------------------------------------
    // MAJ uniquement le mp d'un admin
    // Le nouveau mp est hashé avant d'être enregistré
    // -------------------------------------------------------------------------
    public function updatePassword(int $id, string $newPassword): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET password = :password
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':password' => password_hash($newPassword, PASSWORD_BCRYPT),
            ':id'       => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Enregistre la date et l'heure de la dernière co de l'admin
    // Appelée automatiquement après une co réussie
    // -------------------------------------------------------------------------
    public function updateLastLogin(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET last_login = :last_login
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':last_login' => date('Y-m-d H:i:s'),
            ':id'         => $id,
        ]);
    }
}