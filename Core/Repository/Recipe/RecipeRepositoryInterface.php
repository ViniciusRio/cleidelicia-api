<?php

namespace Core\Repository\Recipe;

use Models\Recipe\Recipe;

interface RecipeRepositoryInterface
{
    /**
     * @return array|Recipe[]
     */
    function findAllRecipes(array $validColumns = ['id'], ?string $sortBy = null, ?string $sortOrder = 'ASC'): array;

    function findRecipeById($id): Recipe;

    function saveRecipe(array $data): Recipe;

    function updateRecipe(string $clause, array $bindings): Recipe;

    function deleteRecipe(int $id): void;
}