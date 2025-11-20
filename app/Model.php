<?php

namespace App;

use Exception;
use PDO;

abstract class Model
{

    private const string DB_USER = 'root';
    private const string DB_NAME = 'test';
    private const string DB_HOST = 'localhost';
    private const string DB_PASSWORD = '1234';

    protected $connection;

    protected $table;
    protected $id;

    /**
     * Initialise la connexion PDO à la base de données et la stocke dans $this->connection.
     *
     * @return void
     *
     * @throws PDOException Si la connexion échoue.
     */
    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST, self::DB_USER, self::DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "⚠️ Une erreur est survenue :" . $e->getMessage();
        }
    }

    /**
     * Récupère tous les enregistrements de la table.
     *
     * @return array Liste des enregistrements sous forme de tableau.
     */
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
