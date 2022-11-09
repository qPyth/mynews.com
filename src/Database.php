<?php
declare(strict_types=1);
namespace NewsSite;

Use PDO;
use PDOException;

class Database
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * Database constructor.
     * @param $dsn
     * @param $username
     * @param $password
     */
    public function __construct($dsn, $username, $password)
    {
        try {
            $this->connection = new PDO($dsn, $username, $password);
            if(!$this->connection) {
                throw new PDOException();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}