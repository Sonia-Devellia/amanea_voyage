<?php

// ============================================================
// app/services/PexelsService.php
// Service pour récupérer des photos depuis l'API Pexels
// Documentation : https://www.pexels.com/api/documentation/
// ============================================================

namespace App\Services;

class PexelsService
{
    // Clé API chargée depuis le .env (ex: PEXELS_API_KEY=xxx)
    private string $apiKey;

    // URL de base de l'endpoint de recherche Pexels
    private const API_URL = 'https://api.pexels.com/v1/search';

    public function __construct()
    {
        // $_ENV est peuplé par le chargement du .env (ex: via vlucas/phpdotenv)
        // Si la clé est absente, $apiKey vaudra '' et toutes les requêtes
        // retourneront null/[] sans lever d'erreur
        $this->apiKey = $_ENV['PEXELS_API_KEY'] ?? '';
    }

    // -------------------------------------------------------------------------
    // Récupère la première photo correspondant au mot-clé
    //
    // @param string $keyword  Mot-clé de recherche (ex: "nature", "city")
    // @param string $size     Taille souhaitée parmi les clés retournées par
    //                         Pexels dans $photo['src'] :
    //                         original | large2x | large | medium | small |
    //                         portrait | landscape | tiny
    //
    // @return string|null     URL directe de l'image, ou null si :
    //                           - clé API ou mot-clé manquant
    //                           - erreur HTTP (pas 200)
    //                           - aucune photo trouvée
    //                           - taille demandée inexistante dans la réponse
    // -------------------------------------------------------------------------
    public function getPhoto(string $keyword, string $size = 'large', int $seed = 0): ?string
    {
        // Garde-fou : inutile d'appeler l'API sans clé ou sans mot-clé
        if (empty($this->apiKey) || empty($keyword)) {
            return null;
        }

        // per_page=15 → on récupère un pool de photos pour varier selon le seed
        // Le seed (Id_ARTICLE) permet de choisir une photo différente par article
        // même quand plusieurs articles partagent le même mot-clé
        $perPage = 15;
        $url = self::API_URL . '?' . http_build_query([
            'query'    => $keyword,
            'per_page' => $perPage,
            'size'     => $size,
        ]);

        // Initialisation d'une session cURL
        $ch = curl_init();

        // Configuration de la requête :
        //   CURLOPT_URL            → endpoint cible
        //   CURLOPT_RETURNTRANSFER → retourner la réponse comme string 
        //   CURLOPT_HTTPHEADER     → Authorization requis par l'API Pexels 
        //   CURLOPT_TIMEOUT        → abandon après 5 s (évite de bloquer le rendu de page)
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Authorization: ' . $this->apiKey,
            ],
            CURLOPT_TIMEOUT        => 5,
        ]);

        // Exécution de la requête et récupération du code HTTP
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // curl_close() déprécié depuis PHP 8.0 : la ressource est libérée automatiquement

        // On rejette toute réponse qui n'est pas un 200 OK, ou vide
        if ($httpCode !== 200 || !$response) {
            return null;
        }

        // Décodage du JSON : Pexels retourne { page, per_page, photos: [...], ... }
        $data = json_decode($response, true);

        if (empty($data['photos'])) {
            return null;
        }

        // Sélection de la photo via le seed : Id_ARTICLE % nombre de résultats
        // → articles différents = photos différentes, même avec le même mot-clé
        // → résultat déterministe (pas de changement au refresh)
        $index = $seed % count($data['photos']);

        return $data['photos'][$index]['src'][$size] ?? null;
    }

    // -------------------------------------------------------------------------
    // Récupère l'URL principale + un srcset pour un hero full-width
    //
    // Retourne un tableau :
    //   'src'    → URL large2x (1880 px) — fallback <img src>
    //   'srcset' → chaîne srcset "large2x 1880w, large 940w"
    //
    // Un seul appel API, deux tailles extraites du même objet photo Pexels.
    // -------------------------------------------------------------------------
    public function getPhotoSrcset(string $keyword, int $seed = 0): ?array
    {
        if (empty($this->apiKey) || empty($keyword)) {
            return null;
        }

        $perPage = 15;
        $url = self::API_URL . '?' . http_build_query([
            'query'    => $keyword,
            'per_page' => $perPage,
        ]);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Authorization: ' . $this->apiKey],
            CURLOPT_TIMEOUT        => 5,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode !== 200 || !$response) {
            return null;
        }

        $data = json_decode($response, true);

        if (empty($data['photos'])) {
            return null;
        }

        $index = $seed % count($data['photos']);
        $src   = $data['photos'][$index]['src'] ?? [];

        $large2x = $src['large2x'] ?? null;
        $large   = $src['large']   ?? null;

        if (!$large2x && !$large) {
            return null;
        }

        // srcset : le navigateur choisit large2x sur écrans larges/Retina,
        // large sur mobile — un seul appel réseau côté serveur.
        $srcset = implode(', ', array_filter([
            $large2x ? $large2x . ' 1880w' : null,
            $large   ? $large   . ' 940w'  : null,
        ]));

        return [
            'src'    => $large2x ?? $large,
            'srcset' => $srcset,
        ];
    }

    // -------------------------------------------------------------------------
    // Récupère plusieurs photos correspondant au mot-clé pour alimenter les contenus des articles
    //
    // @param string $keyword  Mot-clé de recherche
    // @param int    $count    Nombre de photos souhaitées (max 80 selon l'API)
    // @param string $size     Taille souhaitée (voir getPhoto())
    //
    // @return array           Tableau d'URLs (string|null par élément),
    //                         tableau vide en cas d'erreur
    // -------------------------------------------------------------------------
    public function getPhotos(string $keyword, int $count = 3, string $size = 'large'): array
    {
        if (empty($this->apiKey) || empty($keyword)) {
            return [];
        }

        $url = self::API_URL . '?' . http_build_query([
            'query'    => $keyword,
            'per_page' => $count,
            'size'     => $size,
        ]);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Authorization: ' . $this->apiKey,
            ],
            CURLOPT_TIMEOUT        => 5,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode !== 200 || !$response) {
            return [];
        }

        $data = json_decode($response, true);

        if (empty($data['photos'])) {
            return [];
        }

        // array_map() transforme chaque objet photo en une simple URL
        // fn() est une arrow function PHP 7.4+ : elle capture $size du scope parent
        return array_map(fn($photo) => $photo['src'][$size] ?? null, $data['photos']);
    }
}
