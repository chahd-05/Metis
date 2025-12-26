<?php
require_once __DIR__ . '/../Database/Database.php';

abstract class BaseModel
{
    protected static string $table;
    protected ?int $id = null;

    public function save(array $data)
    {
        $connexion = Database::getConnection();

        $columns = implode(", ", array_keys($data));
        $params  = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($params)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute($data);
        
        $this->id = $connexion->lastInsertId();
    }
    public static function delete(int $id)
    {
        $connexion = Database::getConnection();

        $sql = ("DELETE FROM " . static::$table . " WHERE id = :id");
        $stmt = $connexion->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public static function findById(int $id)
    {
        $connexion = Database::getConnection();

        $sql = ("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt = $connexion->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
