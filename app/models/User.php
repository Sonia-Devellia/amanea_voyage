<?php

// Déclare le namespace : User fait partie des Models
namespace App\Models;

// User hérite de Model 
class User extends Model
{
    // Nom de la table en base de données
    protected string $table = 'USER';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_USER';

    // Le constructeur appelle celui du parent (Model)
    // ce qui déclenche la connexion PDO via Database
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouvel utilisateur en base de données
    // $data est un tableau contenant les champs du formulaire
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        // On prépare la requête SQL avec des paramètres nommés (:nom)
        // pour éviter les injections SQL
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (last_name, first_name, email, password, phone, registration_date, password_changed)
            VALUES
                (:last_name, :first_name, :email, :password, :phone, :registration_date, 0)
        ");

        // Le mP est hashé avec bcrypt avant d'être enregistré
        // password_changed = 0 car c'est un mot de passe temporaire
        return $stmt->execute([
            ':last_name'         => $data['last_name'],
            ':first_name'        => $data['first_name'],
            ':email'             => $data['email'],
            ':password'          => password_hash($data['password'], PASSWORD_BCRYPT),
            ':phone'             => $data['phone'],
            ':registration_date' => date('Y-m-d H:i:s'),
        ]);
    }

    // -------------------------------------------------------------------------
    // MAJ les informations d'un utilisateur existant
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET last_name  = :last_name,
                first_name = :first_name,
                email      = :email,
                phone      = :phone
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':last_name'  => $data['last_name'],
            ':first_name' => $data['first_name'],
            ':email'      => $data['email'],
            ':phone'      => $data['phone'],
            ':id'         => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Recherche un utilisateur par son adresse email
    // Utilisé lors de la connexion pour retrouver le compte
    // Retourne les données de l'utilisateur ou false si non trouvé
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
    // Vérifie que le mot de passe correspond au hash enregistré en BDD
    // password_verify() compare le mot de passe en clair avec le hash bcrypt
    // Retourne true si le mot de passe est correct, false sinon
    // -------------------------------------------------------------------------
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    // -------------------------------------------------------------------------
    // Met à jour le mot de passe d'un utilisateur
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
    // Marque le mot de passe comme changé après la première connexion
    // password_changed passe de 0 à 1
    // -------------------------------------------------------------------------
    public function markPasswordChanged(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET password_changed = 1
            WHERE {$this->primaryKey} = :id
        ");
        return $stmt->execute([':id' => $id]);
    }

    // -------------------------------------------------------------------------
    // Enregistre l'acceptation des CGV et de la Charte Amanéa
    // terms_accepted passe de 0 à 1 et enregistre la date d'acceptation
    // -------------------------------------------------------------------------
    public function acceptTerms(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET terms_accepted      = 1,
                terms_accepted_date = :terms_accepted_date
            WHERE {$this->primaryKey} = :id
        ");
 
        return $stmt->execute([
            ':terms_accepted_date' => date('Y-m-d H:i:s'),
            ':id'                  => $id,
        ]);
    }
 

    // Récupère tous les projets de voyage d'un utilisateur
    public function getTravelProjects(int $id): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM TRAVEL_PROJECT
            WHERE Id_USER = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll();
    }
}