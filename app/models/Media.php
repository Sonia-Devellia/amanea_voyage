<?php

// On déclare le namespace
namespace App\Models;

// Media hérite de Model 
class Media extends Model
{
    // Nom de la table en bdd
    protected string $table = 'MEDIA';

    // Nom de la clé primaire de la table
    protected string $primaryKey = 'Id_MEDIA';

    // Le constructeur appelle celui du parent (Model)
    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // Crée un nouveau média en bd $data contient le nom du fichier, la légende et le copyright
    // Retourne true si l'insertion a réussi, false sinon
    // -------------------------------------------------------------------------
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (file_name, upload_date, caption, copyright)
            VALUES
                (:file_name, :upload_date, :caption, :copyright)
        ");

        return $stmt->execute([
            ':file_name'   => $data['file_name'],
            ':upload_date' => date('Y-m-d H:i:s'),
            ':caption'     => $data['caption']   ?? null,
            ':copyright'   => $data['copyright'] ?? null,
        ]);
    }

    // -------------------------------------------------------------------------
    // Maj les informations d'un média existant
    // -------------------------------------------------------------------------
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET caption   = :caption,
                copyright = :copyright
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            ':caption'   => $data['caption']   ?? null,
            ':copyright' => $data['copyright'] ?? null,
            ':id'        => $id,
        ]);
    }

    // ---------------------------------------------------------------------------------------------------------
    // Récupère l'image de couverture d'un article via CONTAINS_CONTENTS (is_cover = 1)
    // Retourne le média ou false si l'article n'a pas de couverture
    // ----------------------------------------------------------------------------------------------------------
    public function findCoverByArticle(int $idArticle): array|false
    {
        $stmt = $this->db->prepare("
            SELECT m.*
            FROM {$this->table} m
            JOIN CONTAINS_CONTENTS cc ON cc.Id_MEDIA = m.Id_MEDIA
            WHERE cc.Id_ARTICLE = :id_article
              AND cc.is_cover = 1
        ");

        $stmt->execute([':id_article' => $idArticle]);
        return $stmt->fetch();
    }

    // -------------------------------------------------------------------------
    // Récupère tous les médias du contenu d'un article
    // Fait une jointure sur la table CONTAINS_CONTENTS
    // -------------------------------------------------------------------------
    public function findContentsByArticle(int $idArticle): array
    {
        $stmt = $this->db->prepare("
            SELECT m.*
            FROM {$this->table} m
            INNER JOIN CONTAINS_CONTENTS cc ON cc.Id_MEDIA = m.Id_MEDIA
            WHERE cc.Id_ARTICLE = :id_article
        ");

        $stmt->execute([':id_article' => $idArticle]);
        return $stmt->fetchAll();
    }
}