<?php

// On déclare le namespace
namespace App\Models;

// Travel hérite de Model
class Travel extends Model
{
    // Nom de la table en bdd
    protected string $table = 'TRAVEL';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_TRAVEL';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouveau voyage en bdd
    // Nouveau schéma : duration_days, min_persons, max_persons, season_start,
    // season_end, Id_TYPE, Id_MEDIA — remplacent badge/duration/persons/season/cover_image
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (title, Id_DESTINATION, description, price, is_published,
                 duration_days, min_persons, max_persons, season_start, season_end,
                 Id_TYPE, Id_MEDIA)
            VALUES
                (:title, :id_destination, :description, :price, :is_published,
                 :duration_days, :min_persons, :max_persons, :season_start, :season_end,
                 :id_type, :id_media)
        ");

        return $stmt->execute([
            ':title'          => $data['title'],
            ':id_destination' => $data['id_destination'] ?? null,
            ':description'    => $data['description']    ?? null,
            ':price'          => $data['price']           ?? null,
            ':is_published'   => $data['is_published']    ? 1 : 0,
            ':duration_days'  => $data['duration_days']  ?? null,
            ':min_persons'    => $data['min_persons']     ?? null,
            ':max_persons'    => $data['max_persons']     ?? null,
            ':season_start'   => $data['season_start']   ?? null,
            ':season_end'     => $data['season_end']     ?? null,
            ':id_type'        => $data['id_type']        ?? null,
            ':id_media'       => $data['id_media']       ?? null,
        ]);
    }

    // -------------------------------------------------------------------------
    // Met à jour un voyage existant
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET title          = :title,
                Id_DESTINATION = :id_destination,
                description    = :description,
                price          = :price,
                is_published   = :is_published,
                duration_days  = :duration_days,
                min_persons    = :min_persons,
                max_persons    = :max_persons,
                season_start   = :season_start,
                season_end     = :season_end,
                Id_TYPE        = :id_type,
                Id_MEDIA       = :id_media
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':title'          => $data['title'],
            ':id_destination' => $data['id_destination'] ?? null,
            ':description'    => $data['description']    ?? null,
            ':price'          => $data['price']           ?? null,
            ':is_published'   => $data['is_published']    ? 1 : 0,
            ':duration_days'  => $data['duration_days']  ?? null,
            ':min_persons'    => $data['min_persons']     ?? null,
            ':max_persons'    => $data['max_persons']     ?? null,
            ':season_start'   => $data['season_start']   ?? null,
            ':season_end'     => $data['season_end']     ?? null,
            ':id_type'        => $data['id_type']        ?? null,
            ':id_media'       => $data['id_media']       ?? null,
            ':id'             => $id,
        ]);
    }

    // -------------------------------------------------------------------------
    // Récupère tous les voyages pour l'index admin
    // Jointure avec DESTINATION, TYPE et MEDIA pour afficher les infos en liste
    // -------------------------------------------------------------------------
    public function findAll(): array
    {
        $stmt = $this->db->query("
            SELECT t.*,
                   d.name    AS destination_name,
                   ty.title  AS type_title,
                   ty.slug   AS type_slug,
                   m.file_name
            FROM {$this->table} t
            LEFT JOIN DESTINATION d  ON d.Id_DESTINATION = t.Id_DESTINATION
            LEFT JOIN TYPE ty        ON ty.Id_TYPE        = t.Id_TYPE
            LEFT JOIN MEDIA m        ON m.Id_MEDIA        = t.Id_MEDIA
            ORDER BY t.Id_TRAVEL DESC
        ");
        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Récupère les voyages publiés avec leurs étapes, pour la page Voyages
    // -------------------------------------------------------------------------
    public function getPublished(): array
    {
        $stmt = $this->db->query("
            SELECT t.*,
                   d.name    AS destination_name,
                   ty.title  AS type_title,
                   ty.slug   AS type_slug,
                   m.file_name
            FROM {$this->table} t
            LEFT JOIN DESTINATION d  ON d.Id_DESTINATION = t.Id_DESTINATION
            LEFT JOIN TYPE ty        ON ty.Id_TYPE        = t.Id_TYPE
            LEFT JOIN MEDIA m        ON m.Id_MEDIA        = t.Id_MEDIA
            WHERE t.is_published = 1
            ORDER BY t.Id_TRAVEL ASC
        ");
        $travels = $stmt->fetchAll();

        // On attache les étapes à chaque voyage
        foreach ($travels as &$travel) {
            $travel['steps'] = $this->getSteps($travel['Id_TRAVEL']);
        }

        return $travels;
    }

    // -------------------------------------------------------------------------
    // Récupère les étapes d'un voyage, ordonnées par position
    // Retourne un tableau de ['city', 'nights', 'position']
    // -------------------------------------------------------------------------
    public function getSteps(int $idTravel): array
    {
        $stmt = $this->db->prepare("
            SELECT city, nights, position
            FROM TRAVEL_STEP
            WHERE Id_TRAVEL = :id_travel
            ORDER BY position ASC
        ");
        $stmt->execute([':id_travel' => $idTravel]);
        return $stmt->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Remplace toutes les étapes d'un voyage (supprime puis réinsère)
    // $steps = tableau de ['city' => ..., 'nights' => ...]
    // -------------------------------------------------------------------------
    public function replaceSteps(int $idTravel, array $steps): bool
    {
        $this->db->prepare("DELETE FROM TRAVEL_STEP WHERE Id_TRAVEL = :id")
                 ->execute([':id' => $idTravel]);

        foreach ($steps as $pos => $step) {
            $stmt = $this->db->prepare("
                INSERT INTO TRAVEL_STEP (Id_TRAVEL, city, nights, position)
                VALUES (:id_travel, :city, :nights, :position)
            ");
            $stmt->execute([
                ':id_travel' => $idTravel,
                ':city'      => $step['city'],
                ':nights'    => isset($step['nights']) && $step['nights'] > 0 ? $step['nights'] : null,
                ':position'  => $pos + 1,
            ]);
        }

        return true;
    }

    // -------------------------------------------------------------------------
    // Retourne l'id du dernier voyage inséré
    // -------------------------------------------------------------------------
    public function getLastId(): int
    {
        return (int) $this->db->lastInsertId();
    }
}
