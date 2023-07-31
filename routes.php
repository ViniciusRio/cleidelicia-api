<?php

$router->get('/recipes', 'recipes/index.php');
$router->get('/recipe', 'recipes/show.php');

$router->get('/', 'index.php');

$router->post('/recipes', 'recipes/store.php');

