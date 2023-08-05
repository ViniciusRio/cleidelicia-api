<?php

namespace Core\Repository;

interface RepositoryInterface
{
    function findAll(string $clause): array;

    function findById($id): array;

    function insert(array $data): array;

    function update(string $clause, array $bindings): array;

    function delete(int $id): void;
}
