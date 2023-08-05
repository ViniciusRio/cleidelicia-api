<?php

namespace Controllers\Recipe;

use Core\Repository\Recipe\RecipeRepositoryInterface;
use Http\Paginator;
use Validation\Recipe\RecipeException;
use Validation\Recipe\RecipeValidation;

class RecipeController
{
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function index(): void
    {
        $page = $_GET['page'] ?? 1;
        $quantity = $_GET['quantity'] ?? 10;

        $recipes = $this->recipeRepository->findAllRecipes();
        $recipes = Paginator::Paginate($recipes, intval($page), intval($quantity));
        response($recipes);
    }

    /**
     * @throws RecipeException
     */
    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        RecipeValidation::IdValidator($id);

        response($this->recipeRepository->findRecipeById($id));
    }

    public function store(): void
    {
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        response($this->recipeRepository->saveRecipe($data), 201);

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

        response($this->recipeRepository->updateRecipe($setClause, $bindings));
    }

    public function destroy(): void
    {
        response($this->recipeRepository->deleteRecipe($_GET['id']));
    }
}