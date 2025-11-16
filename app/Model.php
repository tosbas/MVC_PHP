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

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST, self::DB_USER, self::DB_PASSWORD);
        } catch (Exception $e) {
            echo "⚠️ Une erreur est survenue :" . $e->getMessage();
        }
    }

    public function getAll(){
        
    }
}
