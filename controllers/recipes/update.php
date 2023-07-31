<?php

use Core\App;
use Core\Database;

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

response('Recipe updated successfully', 200);




