<?php

namespace Core\Repository;

interface RepositoryInterface
{
    public function findAll();

    public function findById($id);

    public function insert(array $data);

    public function update(string $clause, array $bindings);

    public function delete(int $id);
}
