<?php

namespace Config;

use PDO;

/**
 * Classe Database — Pattern Singleton
 *
 * Garantit qu'une seule connexion PDO est créée durant toute l'exécution.
 * On accède à cette connexion via Database::getInstance().
 */
class Database
{
    // Stocke la connexion PDO unique. Null tant qu'elle n'a pas été créée.
    private static ?PDO $instance = null;

    /**
     * Constructeur privé 
     * Crée la connexion PDO à partir des variables d'environnement et la stocke.
     */
    private function __construct()
    {
        // DSN (Data Source Name) : chaîne qui indique à PDO le driver, l'hôte,la bdd et l'encodage à utiliser pour la co.
        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";

        // Création de la connexion PDO avec les identifiants de la BDD
        self::$instance = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

        // Les erreurs PDO lèvent des exceptions (plutôt que des warnings silencieux)
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Les résultats des requêtes sont retournés sous forme de tableaux associatifs par défaut
        self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Désactive les requêtes préparées émulées : utilise les vraies requêtes préparées MySQL
        // (meilleure sécurité et typage correct des valeurs retournées)
        self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    // Interdit la duplication de l'objet via "clone" pour respecter le Singleton
    private function __clone() {}

    /**
     * Point d'accès unique à la connexion PDO.
     * Crée la connexion si elle n'existe pas encore, puis la retourne.
     */
    public static function getInstance(): PDO
    {
        // Si aucune connexion n'existe, on en crée une (appelle le constructeur)
        if (self::$instance === null) {
            new self();
        }

        // Retourne toujours la même instance PDO
        return self::$instance;
    }
}
