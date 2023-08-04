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
    public function findAllRecipes(): array
    {
        return Recipe::fromArrayCollection(parent::findAll());
    }

    public function findRecipeById($id): Recipe
    {
        return Recipe::bindingRecipe(parent::findById($id));
    }

    public function saveRecipe(array $data): void
    {
        parent::insert($data);
    }

    public function updateRecipe(string $clause, array $bindings): void
    {
        parent::update($clause, $bindings);
    }

    public function deleteRecipe(int $id): Recipe
    {
        return Recipe::bindingRecipe(parent::delete($id));
    }
}