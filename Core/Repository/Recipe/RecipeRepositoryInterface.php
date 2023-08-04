<?php

namespace Core\Repository\Recipe;

interface RecipeRepositoryInterface
{
    function findAllRecipes();

    function findRecipeById($id);

    function saveRecipe(array $data);

    function updateRecipe(string $clause, array $bindings);

    function deleteRecipe(int $id);
}