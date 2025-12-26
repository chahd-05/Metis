<?php

class Database
{
    private static ?PDO $connexion = null;

    private static string $server = "localhost";
    private static string $db = "metis";
    private static string $user = "root";
    private static string $password = "";
    private static int $port = 3307;

    private function __construct() {}
    public static function getConnection(): PDO
    {
        if (self::$connexion === null) {
            try {
                self::$connexion = new PDO(
                    "mysql:host=" . self::$server . ";port=" . self::$port . ";dbname=" . self::$db . ";charset=utf8",
                    self::$user,
                    self::$password
                );

                self::$connexion->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {
                die("Connection error: " . $e->getMessage());
            }
        }

        return self::$connexion;
    }
}
