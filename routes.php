<?php

$router->get('/recipes', 'RecipeController@index');
$router->get('/recipe', 'RecipeController@show');
$router->patch('/recipes', 'RecipeController@update');
$router->post('/recipes', 'RecipeController@store');
$router->delete('/recipes', 'RecipeController@destroy');
$router->get('/', 'RecipeController@index');

