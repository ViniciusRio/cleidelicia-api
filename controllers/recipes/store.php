<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$db->query('INSERT INTO cleidelicia.recipes (title, description, method, ingredients, level, cooking_time, preparation_time, servers) 
VALUES (:title, :description, :method, :ingredients, :level, :cooking_time, :preparation_time, :servers)', $data);

response('Recipe inserted successfully', 201);


