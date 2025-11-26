<?php

namespace App;

use PDO;
use PDOException;

abstract class Model
{

    private string $dbUser = DB_USER;
    private string $dbName = DB_NAME;
    private string $dbHost = DB_HOST;
    private string $dbPassword = DB_PASSWORD;

    protected ?PDO $connection = null;
    protected string $table;
    protected ?int $id = null;

    /**
     * Initialise la connexion PDO à la base de données et la stocke dans $this->connection.
     *
     * @return void
     *
     * @throws PDOException Si la connexion échoue.
     */
    public function getConnection(): void
    {
        $this->connection = null;

        try {
            $this->connection = new PDO(
                'mysql:dbname=' . $this->dbName . ';host=' . $this->dbHost,
                $this->dbUser,
                $this->dbPassword
            );
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("⚠️ Une erreur est survenue : " . $e->getMessage());
        }
    }

    /**
     * Récupère tous les enregistrements de la table.
     *
     * @return array|null Liste des enregistrements sous forme de tableau.
     */
    public function getAll(): ?array
    {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll() ?: null;
    }

    /**
     * Récupère un enregistrement unique à partir de son identifiant.
     *
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $query = $this->connection->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        return $query->fetch() ?: null;
    }
}
