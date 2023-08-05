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

    public function insert(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO cleidelicia.$this->table ($columns) VALUES ($placeholders) RETURNING *";

        return $this->database->query($sql, $data)->find();

    }

    public function findAll(string $clause): array
    {
        return $this->database->query("SELECT * FROM cleidelicia." . $this->table . $clause)->findAll();
    }

    public function update(string $clause, $bindings)
    {
        return $this->database->query("UPDATE cleidelicia.$this->table SET $clause WHERE id = :id RETURNING *", $bindings)->find();
    }

    public function delete(int $id)
    {
        return $this->database->query("DELETE FROM cleidelicia.$this->table WHERE id = :id RETURNING *", ['id' => $id])->find();
    }

    public function sortByAndSortOrder(?string $sortBy, array $validColumns, ?string $sortOrder): string
    {
        $orderByClause = '';
        if ($sortBy !== null) {
            if (in_array($sortBy, $validColumns)) {
                $orderByClause = " ORDER BY $sortBy $sortOrder";
            }
        }
        return $orderByClause;
    }
}