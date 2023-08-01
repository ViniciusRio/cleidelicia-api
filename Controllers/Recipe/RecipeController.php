<?php

namespace Controllers\Recipe;

use Core\App;
use Core\Database;

class RecipeController
{
    public function index()
    {
        $db = App::resolve(Database::class);
        $result = $db->query("SELECT * FROM cleidelicia.recipes")->findAll();

        response($result);
    }

    public function show()
    {
        $db = App::resolve(Database::class);
        $recipe = $db->query("SELECT * FROM cleidelicia.recipes WHERE id = :id", ['id' => $_GET['id']])->find();

        response($recipe);
    }

    public function store()
    {

        $db = App::resolve(Database::class);

        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        $db->query('INSERT INTO cleidelicia.recipes (title, description, method, ingredients, level, cooking_time, preparation_time, servers) 
            VALUES (:title, :description, :method, :ingredients, :level, :cooking_time, :preparation_time, :servers)', $data);

        response('Recipe inserted successfully', 201);

    }

    public function update()
    {

        $db = App::resolve(Database::class);

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

        $sql = "UPDATE cleidelicia.recipes SET $setClause WHERE id = :id";
        $bindings['id'] = $recipeId;

        $db->query($sql, $bindings);

        response('Recipe updated successfully');
    }

    public function destroy()
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM cleidelicia.recipes WHERE id = :id', ['id' => $_GET['id']]);

        response(true);
    }
}