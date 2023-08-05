<?php

namespace Core\Repository;

interface RepositoryInterface
{
    function findAll(string $clause);

    function findById($id);

    function insert(array $data);

    function update(string $clause, array $bindings);

    function delete(int $id);
}
