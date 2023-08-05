<?php

namespace Core\Repository\Recipe;

use Core\Repository\Repository;
use Models\Recipe\Recipe;

class RecipeRepository extends Repository implements RecipeRepositoryInterface
{
    public function __construct()
    {
        parent::__construct('recipes');
    }

    /**
     * @return array|Recipe[]
     */
    public function findAllRecipes(array $validColumns, ?string $sortBy = null, ?string $sortOrder = 'ASC'): array
    {
        $orderByClause = parent::sortByAndSortOrder($sortBy, $validColumns, $sortOrder);

        return Recipe::fromArrayCollection(parent::findAll($orderByClause));
    }

    public function findRecipeById($id): Recipe
    {
        return Recipe::bindingRecipe(parent::findById($id));
    }

    public function saveRecipe(array $data): Recipe
    {
        return Recipe::bindingRecipe(parent::insert($data));
    }

    public function updateRecipe(string $clause, array $bindings): Recipe
    {
        return Recipe::bindingRecipe(parent::update($clause, $bindings));
    }

    public function deleteRecipe(int $id): Recipe
    {
        return Recipe::bindingRecipe(parent::delete($id));
    }
}