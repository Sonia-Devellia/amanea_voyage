<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    // Instance unique — pattern Singleton
    private static ?PDO $instance = null;

    // Constructeur privé : interdit le new Database()
    private function __construct() {}

    // Clonage interdit
    private function __clone() {}

    // Point d'accès unique à la connexion PDO
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                $dsn = 'mysql:host=' . DB_HOST
                     . ';dbname='    . DB_NAME
                     . ';charset='   . DB_CHARSET;

                self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);

            } catch (PDOException $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
