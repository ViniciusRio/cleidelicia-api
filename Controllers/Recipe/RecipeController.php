<?php

namespace Controllers\Recipe;

use Core\Repository\Recipe\RecipeRepositoryInterface;

class RecipeController
{
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function index(): void
    {
        response($this->recipeRepository->findAllRecipes());
    }

    public function show(): void
    {
        response($this->recipeRepository->findRecipeById($_GET['id']));
    }

    public function store(): void
    {

        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        $this->recipeRepository->saveRecipe($data);

        response('Recipe inserted successfully', 201);

    }

    public function update(): void
    {

        $recipeId = $_GET['id'] ?? null;

        if (!$recipeId) {
            response('Recipe ID not provided', 400);
        }

        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        $setClause = '';
        $bindings = [];

        foreach ($data as $key => $value) {
            if ($key !== 'id') {
                $setClause .= "$key = :$key, ";
                $bindings[$key] = $value;
            }
        }

        $setClause = rtrim($setClause, ', ');

        if (empty($setClause)) {
            response('No data provided for update', 400);
        }

        $bindings['id'] = $recipeId;

        $this->recipeRepository->updateRecipe($setClause, $bindings);

        response('Recipe updated successfully');
    }

    public function destroy(): void
    {

        response($this->recipeRepository->deleteRecipe($_GET['id']));
    }
}