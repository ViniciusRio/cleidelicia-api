<?php

class Database
{
    public PDO $connection;
    public PDOStatement $statement;
    public function __construct($config, $username = 'vlmdr', $password = '1991')
    {
        $dsn = 'pgsql:' . http_build_query($config, '',';' );
        $this->connection = new PDO($dsn, $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function query($query, $params = []) : self
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function fetchAll() : array|false
    {
        return $this->statement->fetchAll();
    }
}