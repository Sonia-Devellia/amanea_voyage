<?php

// On déclare le namespace
namespace App\Models;

// Travel hérite de Model — catalogue des voyages proposés avec prix
class Travel extends Model
{
    protected string $table      = 'TRAVEL';
    protected string $primaryKey = 'Id_TRAVEL';

    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Récupère tous les voyages publiés avec destination + étapes groupées
    // -------------------------------------------------------------------------
    public function getPublished(): array
    {
        $stmt = $this->db->query("
            SELECT t.*, d.name AS destination_name
            FROM {$this->table} t
            LEFT JOIN DESTINATION d ON d.Id_DESTINATION = t.id_destination
            WHERE t.is_published = 1
            ORDER BY t.Id_TRAVEL ASC
        ");
        $travels = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($travels)) return [];

        // Récupère toutes les étapes en une seule requête
        $ids  = implode(',', array_column($travels, 'Id_TRAVEL'));
        $stmt = $this->db->query(
            "SELECT id_travel, label FROM TRAVEL_STEP WHERE id_travel IN ($ids) ORDER BY position ASC"
        );
        $stepsByTravel = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $s) {
            $stepsByTravel[$s['id_travel']][] = $s['label'];
        }

        foreach ($travels as &$t) {
            $t['steps'] = $stepsByTravel[$t['Id_TRAVEL']] ?? [];
        }

        return $travels;
    }

    // -------------------------------------------------------------------------
    // findAll avec le nom de la destination (pour la liste admin — sans étapes)
    // -------------------------------------------------------------------------
    public function findAll(): array
    {
        $stmt = $this->db->query("
            SELECT t.*, d.name AS destination_name
            FROM {$this->table} t
            LEFT JOIN DESTINATION d ON d.Id_DESTINATION = t.id_destination
            ORDER BY t.Id_TRAVEL ASC
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // -------------------------------------------------------------------------
    // Récupère les étapes d'un voyage (labels ordonnés)
    // -------------------------------------------------------------------------
    public function getSteps(int $id_travel): array
    {
        $stmt = $this->db->prepare(
            "SELECT label FROM TRAVEL_STEP WHERE id_travel = :id ORDER BY position ASC"
        );
        $stmt->execute([':id' => $id_travel]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    // -------------------------------------------------------------------------
    // Remplace toutes les étapes d'un voyage (delete + insert)
    // -------------------------------------------------------------------------
    public function replaceSteps(int $id_travel, array $labels): void
    {
        $del = $this->db->prepare("DELETE FROM TRAVEL_STEP WHERE id_travel = :id");
        $del->execute([':id' => $id_travel]);

        if (empty($labels)) return;

        $ins = $this->db->prepare(
            "INSERT INTO TRAVEL_STEP (id_travel, label, position) VALUES (:id, :label, :pos)"
        );
        foreach ($labels as $i => $label) {
            $ins->execute([':id' => $id_travel, ':label' => $label, ':pos' => $i + 1]);
        }
    }

    // -------------------------------------------------------------------------
    // Retourne le dernier ID inséré (utilisé après create())
    // -------------------------------------------------------------------------
    public function getLastId(): int
    {
        return (int) $this->db->lastInsertId();
    }

    // -------------------------------------------------------------------------
    // Crée un nouveau voyage (sans étapes — gérées via replaceSteps)
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (title, id_destination, badge, badge_color, badge_text, cover_image, duration, persons, season, description, price, is_published)
            VALUES
                (:title, :id_destination, :badge, :badge_color, :badge_text, :cover_image, :duration, :persons, :season, :description, :price, :is_published)
        ");

        return $stmt->execute([
            ':title'          => $data['title'],
            ':id_destination' => $data['id_destination'] ?: null,
            ':badge'          => $data['badge']       ?? null,
            ':badge_color'    => $data['badge_color'] ?? '#C58A60',
            ':badge_text'     => $data['badge_text']  ?? '#ffffff',
            ':cover_image'    => $data['cover_image'] ?? null,
            ':duration'       => $data['duration']    ?? null,
            ':persons'        => $data['persons']     ?? null,
            ':season'         => $data['season']      ?? null,
            ':description'    => $data['description'] ?? null,
            ':price'          => $data['price']       ?? null,
            ':is_published'   => isset($data['is_published']) ? 1 : 0,
        ]);
    }

    // -------------------------------------------------------------------------
    // Met à jour un voyage existant (sans étapes — gérées via replaceSteps)
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET title          = :title,
                id_destination = :id_destination,
                badge          = :badge,
                badge_color    = :badge_color,
                badge_text     = :badge_text,
                cover_image    = :cover_image,
                duration       = :duration,
                persons        = :persons,
                season         = :season,
                description    = :description,
                price          = :price,
                is_published   = :is_published
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':title'          => $data['title'],
            ':id_destination' => $data['id_destination'] ?: null,
            ':badge'          => $data['badge']       ?? null,
            ':badge_color'    => $data['badge_color'] ?? '#C58A60',
            ':badge_text'     => $data['badge_text']  ?? '#ffffff',
            ':cover_image'    => $data['cover_image'] ?? null,
            ':duration'       => $data['duration']    ?? null,
            ':persons'        => $data['persons']     ?? null,
            ':season'         => $data['season']      ?? null,
            ':description'    => $data['description'] ?? null,
            ':price'          => $data['price']       ?? null,
            ':is_published'   => isset($data['is_published']) ? 1 : 0,
            ':id'             => $id,
        ]);
    }
}
