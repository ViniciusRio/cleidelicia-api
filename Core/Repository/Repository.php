<?php

namespace Core\Repository;

use Core\App;
use Core\Database;

abstract class Repository implements RepositoryInterface
{
    protected Database $database;
    protected string $table;

    public function __construct($table)
    {
        $this->database = App::resolve(Database::class);
        $this->table = $table;
    }

    public function findById($id)
    {
        return $this->database->query("SELECT * FROM cleidelicia.$this->table WHERE id = :id", ['id' => $id])->find();
    }

    public function insert(array $data): void
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO cleidelicia.$this->table ($columns) VALUES ($placeholders)";

        $this->database->query($sql, $data);

    }

    public function findAll(): array
    {
        return $this->database->query("SELECT * FROM cleidelicia." . $this->table)->findAll();
    }

    public function update(string $clause, $bindings): void
    {
        $this->database->query("UPDATE cleidelicia.$this->table SET $clause WHERE id = :id", $bindings);
    }

    public function delete(int $id)
    {
        return $this->database->query("DELETE FROM cleidelicia.$this->table WHERE id = :id RETURNING *", ['id' => $id])->find();
    }
}